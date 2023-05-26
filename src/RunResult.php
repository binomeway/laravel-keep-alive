<?php

namespace BinomeWay\KeepAlive;

class RunResult implements \BinomeWay\KeepAlive\Contracts\Result
{

    public function __construct(public ?string $message = null, public bool $successful = false)
    {
    }


    public static function success(?string $message = null): static
    {
        return new static($message, true);
    }

    public static function error(?string $message = null): static
    {
        return new static($message, false);
    }


    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    public function message(): ?string
    {
        return $this->message;
    }
}
