<?php

namespace BinomeWay\KeepAlive\Concerns;

use Illuminate\Console\Command;

trait HasCommand
{
    protected ?Command $command = null;

    public function withCommand(Command $command): static
    {
        $this->command = $command;

        return $this;
    }

    public function command(): ?Command
    {
        return $this->command;
    }
}
