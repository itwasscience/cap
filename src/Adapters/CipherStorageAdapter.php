<?php

declare(strict_types=1);

namespace Cap\Adapters;

use Cap\Domains\Cipher\SubstitutionCipherEntity;
use \Cap\UseCases\EncodeMessageUseCase\EncodeMessageStorageInterface;
use \Cap\Drivers\StorageDriver\StorageDriverInterface;

class CipherStorageAdapter implements EncodeMessageStorageInterface
{
    protected $storageDriver;

    public function __construct(StorageDriverInterface $storageDriver) {
        $this->storageDriver = $storageDriver;
    }

    public function findCipherById($id): SubstitutionCipherEntity {
        return $this->storageDriver->findSubstitutionCipherById($id);
    }
}