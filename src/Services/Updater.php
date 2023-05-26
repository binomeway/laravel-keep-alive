<?php

namespace BinomeWay\KeepAlive\Services;

use BinomeWay\KeepAlive\Concerns\HasCommand;
use BinomeWay\KeepAlive\Concerns\WithProgress;
use BinomeWay\KeepAlive\Contracts\Result;
use BinomeWay\KeepAlive\Contracts\RunnableAction;
use BinomeWay\KeepAlive\Facades\Version;
use BinomeWay\KeepAlive\RunResult;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Updater implements RunnableAction
{
    use WithProgress;
    use HasCommand;

    public function __construct(protected array $updates = [])
    {

    }

    /**
     * @throws FileNotFoundException
     * @throws \Throwable
     */
    public function run(): Result
    {
        if (! $this->shouldUpdate()) {

            return RunResult::success(__('Application is up to date.'));
        }

        return $this->runUpdates();
    }

    public function updatesCount(): int
    {
        return count($this->updates, COUNT_RECURSIVE);
    }

    /**
     * @throws FileNotFoundException
     * @throws \Exception
     */
    private function runUpdates(): Result
    {
        $this->progressStart($this->updatesCount());

        foreach ($this->updates as $edition => $actions) {

            if (! Version::compare($edition, '<')) {
                continue;
            }

            $actions = is_array($actions) ? $actions : [$actions];

            try {

                foreach ($actions as $action) {
                    app($action)->run();
                    $this->progressAdvance();
                }

                Version::update($edition);

            } catch (\Exception $exception) {

                return RunResult::error("Update failed at '$edition' step with message: '{$exception->getMessage()}'");
            }
        }

        $this->progressFinish();

        return RunResult::success(__('App updated to the latest version :version', [
            'version' => Version::value(),
        ]));
    }

    protected function shouldUpdate(): bool
    {
        if (empty($this->updates)) {
            return false;
        }

        if (Version::isLatest()) {
            return false;
        }

        foreach ($this->updates as $edition => $action) {
            if (Version::compare($edition, '<')) {
                return true;
            }
        }

        return false;
    }
}
