<?php

declare(strict_types=1);

namespace Cap\Domains\CipherEntity;


interface CipherImplementation
{
    public function encode(string $inputString, string $cipherString) : string;
    public function decode(string $inputString, string $cipherString) : string;
}