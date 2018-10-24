<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

use Cap\Domains\Cipher\SubstitutionCipherEntity;

interface EncodeMessageStorageInterface
{
    public function findCipherById(int $id) : SubstitutionCipherEntity;
}