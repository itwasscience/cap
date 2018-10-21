<?php

declare(strict_types=1);

namespace Cap\Adapters\StorageAdapter;

class CipherModel
{
    protected $id;
    protected $cipher;
    protected $notes;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCipher()
    {
        return $this->cipher;
    }

    public function setCipher($cipher): self
    {
        $this->cipher = $cipher;
        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes): self
    {
        $this->notes = $notes;
        return $this;
    }
}