<?php

declare(strict_types=1);

namespace Cap\UseCases\EncodeMessageUseCase;

use Cap\Adapters\StorageAdapter\CipherModel;
use Cap\Adapters\StorageAdapter\StorageAdapterInterface;

class EncodeMessageUseCase implements EncodeMessageInterface
{
    protected $storageAdapter;
    protected $cipherEntity;

    public function __construct(StorageAdapterInterface $storageAdapter, $cipherEntity)
    {
        $this->storageAdapter = $storageAdapter;
        $this->cipherEntity = $cipherEntity;
    }

    public function encode(EncodeMessage $encodeMessage): EncodeMessage
    {
        /** @var CipherModel $cipherModel */
        $cipherModel = $this->storageAdapter->findCipherById($encodeMessage->getCipherId());
        $cipherModel->getCipher();

        $cipherText = $this->cipherEntity->encode($encodeMessage->getPlainText(), $cipherModel->getCipher());
        $response = clone $encodeMessage;
        $response->setCipherText($cipherText);

        return $response;
    }
}