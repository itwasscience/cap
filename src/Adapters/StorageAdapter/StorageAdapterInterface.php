<?php

declare(strict_types=1);

namespace Cap\Adapters\StorageAdapter;

interface StorageAdapterInterface
{
    public function findCipherById(int $id) : CipherModel;
}