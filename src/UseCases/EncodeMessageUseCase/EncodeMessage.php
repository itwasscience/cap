<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

class EncodeMessage
{
    protected $plainText;
    protected $cipherText;
    protected $cipherId;

    public function getPlainText(): string
    {
        return $this->plainText;
    }

    public function setPlainText(string $plainText): self
    {
        $this->plainText = $plainText;
        return $this;
    }

    public function getCipherText(): string
    {
        return $this->cipherText;
    }

    public function setCipherText(string $cipherText): self
    {
        $this->cipherText = $cipherText;
        return $this;
    }

    public function getCipherId(): int
    {
        return $this->cipherId;
    }

    public function setCipherId(int $cipherId): self
    {
        $this->cipherId = $cipherId;
        return $this;
    }
}