<?php

namespace Cap\UseCases\DecodeMessageUseCase;

interface EncodeMessageInterface
{
    public function encode(EncodeMessage $encodeMessage) : EncodeMessage;
}