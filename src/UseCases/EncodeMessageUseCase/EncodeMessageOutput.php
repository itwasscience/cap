<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

class EncodeMessageOutput
{
    protected $cipherText;

    public function getCipherText(): string
    {
        return $this->cipherText;
    }

    public function setCipherText(string $cipherText): self
    {
        $this->cipherText = $cipherText;
        return $this;
    }
}