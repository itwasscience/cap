<?php

declare(strict_types=1);

namespace Cap\Adapters\StorageAdapter;

use Cap\Adapters\StorageAdapter\CipherModel;
use Cap\Adapters\StorageAdapter\StorageAdapterInterface;

class FileStorageAdapter implements StorageAdapterInterface
{

    protected $storageDriver;

    public function __construct(StorageAdapterInterface $storageDriver)
    {
        $this->storageDriver = $storageDriver;
    }

    public function findCipherById(int $id): CipherModel
    {
        return $this->storageDriver->findCipherById($id);
    }
}