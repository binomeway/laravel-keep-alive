<?php

namespace BinomeWay\KeepAlive\Services;

use BinomeWay\KeepAlive\Concerns\HasCommand;
use BinomeWay\KeepAlive\Concerns\WithProgress;
use BinomeWay\KeepAlive\Contracts\Result;
use BinomeWay\KeepAlive\Contracts\RunnableAction;
use BinomeWay\KeepAlive\Facades\Version;
use BinomeWay\KeepAlive\RunResult;

class Installer implements RunnableAction
{
    use WithProgress;
    use HasCommand;

    public function __construct(protected readonly array $steps)
    {
    }


    /**
     * @throws \Exception
     */
    public function run(): Result
    {
        $steps = $this->steps;

        $this->progressStart(count($steps));

        foreach ($steps as $step) {

            try {

                app($step)->run();

                $this->progressAdvance();

            } catch (\Exception $exception) {

                return RunResult::error("Installation failed at '$step' step with message: '{$exception->getMessage()}'");
            }
        }

        Version::update(Version::latest());

        $this->progressFinish();

        return RunResult::success();
    }
}
