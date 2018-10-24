<?php

declare(strict_types=1);

namespace Cap\Adapters;

interface CipherStorageAdapterInterface
{
    public function findCipherById(int $id) : CipherModel;
}