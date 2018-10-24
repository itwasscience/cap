<?php

declare(strict_types=1);

namespace Cap\Adapters;

use Cap\Domains\Cipher\SubstitutionCipherEntity;
use \Cap\UseCases\EncodeMessageUseCase\EncodeMessageStorageInterface;

class CipherStorageAdapter implements EncodeMessageStorageInterface
{
    protected $storageDriver;

    public function __construct(CipherStorageAdapterInterface $storageDriver) {
        $this->storageDriver = $storageDriver;
    }

    public function findCipherById($id): SubstitutionCipherEntity {
        $cipherModel = $this->storageDriver->findCipherById($id);

        $substitutionCipherEntity = new SubstitutionCipherEntity();
        $substitutionCipherEntity->setCipher($cipherModel->getCipher());

        return $substitutionCipherEntity;
    }
}