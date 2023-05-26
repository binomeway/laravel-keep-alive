<?php

namespace BinomeWay\KeepAlive\Contracts;

interface Result
{
    public function isSuccessful(): bool;

    public function message(): ?string;
}
