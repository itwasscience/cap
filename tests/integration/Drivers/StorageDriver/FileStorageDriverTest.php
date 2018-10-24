<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cap\Adapters\StorageAdapter\CipherModel;
use Cap\Drivers\StorageDriver\FileStorageDriver;

class FileStorageDriverTest extends TestCase
{
    public function testFindCipherById_whenFileHasRequestedData_thenExpectEquals()
    {
        $filename = "/tmp/cipher.csv";
        $data = "103,ABCDEFGHIJKLMNOPQRSTUVWXYZ,Test Notes\n104,foo,foo";
        $this->createTestFileWithData($filename, $data);

        $storageDriver = new FileStorageDriver($filename);
        $cipherModel = $storageDriver->findCipherById(103);

        $this->assertEquals(103, $cipherModel->getId());
        $this->assertEquals("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $cipherModel->getCipher());
        $this->assertEquals("Test Notes", $cipherModel->getNotes());
    }

    public function testFindCipherById_whenFileIsPresetButDataIsNotFound_thenExpectException() {
        $this->expectException(\Exception::class);

        $filename = "/tmp/cipher.csv";
        $data = "103,ABCDEFGHIJKLMNOPQRSTUVWXYZ,Test Notes\n104,foo,foo";
        $this->createTestFileWithData($filename, $data);

        $storageDriver = new FileStorageDriver($filename);
        $storageDriver->findCipherById(9999); // Should throw Exception
    }

    public function testFindCipherById_whenFileDoesNotExist_thenExpectException() {
        $this->expectException(\Exception::class);

        $storageDriver = new FileStorageDriver("/tmp/foo/some/file/that/is/not/here");
        $storageDriver->findCipherById(103); // Should throw Exception
    }

    protected function createTestFileWithData(string $filename, string $data) : void {
        $handle = fopen($filename, 'w') or die('Cannot open file: ' . $filename);
        fwrite($handle, $data);
        fclose($handle);
    }
}
