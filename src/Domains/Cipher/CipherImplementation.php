<?php

declare(strict_types=1);

namespace Cap\Domains\Cipher;

interface CipherImplementation
{
    public function encode(string $inputString, string $cipherString) : string;
    public function decode(string $inputString, string $cipherString) : string;
}