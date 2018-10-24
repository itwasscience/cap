<?php

declare(strict_types=1);

namespace Cap\Drivers\StorageDriver;

use Cap\Domains\Cipher\SubstitutionCipherEntity;

interface StorageDriverInterface
{
    public function __construct(string $filename);
    public function findSubstitutionCipherById(int $id): SubstitutionCipherEntity;
}