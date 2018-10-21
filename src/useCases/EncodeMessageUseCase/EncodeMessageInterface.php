<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

interface EncodeMessageInterface
{
    public function encode(EncodeMessage $encodeMessage) : EncodeMessage;
}