<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

class EncodeMessageInput
{
    protected $plainText;
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