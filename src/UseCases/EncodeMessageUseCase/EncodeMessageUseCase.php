<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

use Cap\Adapters\CipherStorageAdapterInterface;

class EncodeMessageUseCase implements EncodeMessageInterface
{
    protected $storageAdapter;
    protected $cipherEntity;

    public function __construct(CipherStorageAdapterInterface $storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;
    }

    public function encode(EncodeMessage $encodeMessage): EncodeMessage
    {
        $cipher = $this->storageAdapter->findCipherById($encodeMessage->getCipherId());

        $cipherText = $cipher->encode($encodeMessage->getPlainText());
        $response = clone $encodeMessage;
        $response->setCipherText($cipherText);

        return $response;
    }
}