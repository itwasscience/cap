<?php

declare(strict_types=1);

use Cap\UseCases\EncodeMessageUseCase\EncodeMessageUseCase;
use Cap\UseCases\EncodeMessageUseCase\EncodeMessage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class EncodeMessageUseCaseTest extends TestCase
{
    public function testEncode_givenValidEncodeMessage_thenExpectedResult() {
        $mockSubstitutionCipher = $this->buildSubstitutionMockClass();
        $storageAdapterMock = $this->buildSubstitutionMockClass();

        $encodeMessage = new EncodeMessage();
        $encodeMessage->setCipherRequest(103);
        $encodeMessage->setPlaintext("This is some string to encode");

        $encodeMessageUseCase = new EncodeMessageUseCase($mockSubstitutionCipher, $storageAdapterMock);
        $resultMessage = $encodeMessageUseCase->encode($encodeMessage);

        $this->assertEquals("MOCK RESULT ENCODE", $resultMessage->getCiphertext());
    }

    protected function buildStorageAdapterMock(): MockObject {
        $storageAdapter = $this->getMockBuilder('Cap\Adapter\StorageAdapter')
            ->disableOriginalConstructor()
            ->getMock();
        $storageAdapter->method('findById')->willReturn('');

        return $storageAdapter;
    }

    protected function buildSubstitutionMockClass() : MockObject {
        $substitutionCipher = $this->getMockBuilder('Cap\Domains\SubstitutionCipherEntity')
            ->getMock();
        $substitutionCipher->method('encode')->willReturn("MOCK RESULT ENCODE");
        $substitutionCipher->method('decode')->willReturn("MOCK RESULT DECODE");

        return $substitutionCipher;
    }
}
