<?php

declare(strict_types=1);

use Cap\Domains\Cipher\SubstitutionCipherEntity;
use Cap\UseCases\EncodeMessageUseCase\EncodeMessageUseCase;
use Cap\UseCases\EncodeMessageUseCase\EncodeMessage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class EncodeMessageUseCaseTest extends TestCase
{
    public function testEncode_givenValidEncodeMessage_thenExpectedResult() {
        $storageAdapterMock = $this->buildStorageAdapterMock();

        $encodeMessage = new EncodeMessage();
        $encodeMessage->setCipherId(103);
        $encodeMessage->setPlaintext("This is some string to encode");

        $encodeMessageUseCase = new EncodeMessageUseCase($storageAdapterMock);
        $resultMessage = $encodeMessageUseCase->encode($encodeMessage);

        $this->assertEquals("GSRH RH HLNV HGIRMT GL VMXLWV", $resultMessage->getCiphertext());
    }

    protected function buildStorageAdapterMock(): MockObject {
        $storageAdapter = $this->getMockBuilder('Cap\UseCases\EncodeMessageUseCase\EncodeMessageStorageInterface')
            ->disableOriginalConstructor()
            ->setMethods(array('findCipherById'))
            ->getMock();

        $cipherResult = new SubstitutionCipherEntity();
        $cipherResult->setCipher("ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $storageAdapter->method('findCipherById')->willReturn($cipherResult);

        return $storageAdapter;
    }
}
