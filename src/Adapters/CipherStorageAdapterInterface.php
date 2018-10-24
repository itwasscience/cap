<?php

declare(strict_types=1);

namespace Cap\Adapters;

use Cap\Domains\Cipher\SubstitutionCipherEntity;

interface CipherStorageAdapterInterface
{
    public function findCipherById(int $id) : SubstitutionCipherEntity;
}