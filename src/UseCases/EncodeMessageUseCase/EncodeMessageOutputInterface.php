<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

interface EncodeMessageOutputInterface
{
    public function getEncodeOutput() : EncodeMessageOutput;
}