<?php

namespace Cap\UseCases\EncodeMessageUseCase;

interface EncodeMessageInterface
{
    public function encode(EncodeMessage $encodeMessage) : EncodeMessage;
}