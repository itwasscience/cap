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
        $storageAdapterMock = $this->buildStorageAdapterMock();

        $encodeMessage = new EncodeMessage();
        $encodeMessage->setCipherId(103);
        $encodeMessage->setPlaintext("This is some string to encode");

        $encodeMessageUseCase = new EncodeMessageUseCase($storageAdapterMock, $mockSubstitutionCipher);
        $resultMessage = $encodeMessageUseCase->encode($encodeMessage);

        $this->assertEquals("MOCK RESULT ENCODE", $resultMessage->getCiphertext());
    }

    protected function buildStorageAdapterMock(): MockObject {
        $storageAdapter = $this->getMockBuilder('Cap\Adapters\StorageAdapter\StorageAdapterInterface')
            ->disableOriginalConstructor()
            ->setMethods(array('findCipherById'))
            ->getMock();

        $cipherResult = new \Cap\Adapters\StorageAdapter\CipherModel();
        $cipherResult->setId(103);
        $cipherResult->setCipher("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $cipherResult->setNotes("Mock CipherModel Result");

        $storageAdapter->method('findCipherById')->willReturn($cipherResult);

        return $storageAdapter;
    }

    protected function buildSubstitutionMockClass() : MockObject {
        $substitutionCipher = $this->getMockBuilder('Cap\Domains\Cipher\SubstitutionCipherEntity')->getMock();
        $substitutionCipher->method('encode')->willReturn("MOCK RESULT ENCODE");
        $substitutionCipher->method('decode')->willReturn("MOCK RESULT DECODE");

        return $substitutionCipher;
    }
}
