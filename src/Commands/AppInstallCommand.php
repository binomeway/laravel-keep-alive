<?php

namespace BinomeWay\KeepAlive\Commands;

use BinomeWay\KeepAlive\Facades\Installer;
use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the application.';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): int
    {
        $result = Installer::withCommand($this)->run();
        $message = $result->message();

        if ($result->isSuccessful()) {

            $this->output->success($message);

            return Command::SUCCESS;
        }

        $this->error($message);

        return Command::FAILURE;
    }
}
