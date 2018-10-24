<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

interface EncodeMessageInputInterface
{
    public function encode(EncodeMessageInput $encodeMessage) : EncodeMessageInput;
}