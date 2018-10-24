<?php

declare(strict_types=1);

namespace Cap\Adapters;

class CipherModel
{
    protected $id;
    protected $cipher;
    protected $notes;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCipher(): string
    {
        return $this->cipher;
    }

    public function setCipher($cipher): self
    {
        $this->cipher = $cipher;
        return $this;
    }

    public function getNotes() : string
    {
        return $this->notes;
    }

    public function setNotes($notes): self
    {
        $this->notes = $notes;
        return $this;
    }
}
