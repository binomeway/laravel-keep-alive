<?php

namespace BinomeWay\KeepAlive\Commands;

use BinomeWay\KeepAlive\Facades\Updater;
use Illuminate\Console\Command;

class AppUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the application to the latest version.';

    /**
     * Execute the console command.
     *
     *
     * @throws \Throwable
     */
    public function handle(): int
    {
        $result = Updater::withCommand($this)->run();

        $message = $result->message();

        if ($result->isSuccessful()) {

            $this->output->success($message);

            return Command::SUCCESS;
        }


        $this->error($message);

        return Command::FAILURE;
    }
}
