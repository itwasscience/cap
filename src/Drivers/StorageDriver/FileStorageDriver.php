<?php

declare(strict_types=1);

namespace Cap\Drivers\StorageDriver;

use Cap\Domains\Cipher\SubstitutionCipherEntity;
use Cap\UseCases\EncodeMessageUseCase\CipherModel;
use Cap\UseCases\EncodeMessageUseCase\EncodeMessageStorageInterface;

class FileStorageDriver implements EncodeMessageStorageInterface
{
    const CSV_FIELDS = array("id", "cipher", "notes");

    protected $filename = '';
    protected $csvData = array();

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function findCipherById(int $id): SubstitutionCipherEntity
    {
        $data = $this->loadDiskData();
        if ( !isset($data[$id])) {
            throw new \Exception("StorageAdapter: Cipher ID was not found!");
        }
        $cipherModel = $this->hydrateCipherModelFromCsvRow($data[$id]);
        return $cipherModel;
    }

    protected function loadDiskData() : array {
        try {
            $csvData = array();
            $handle = fopen($this->filename, 'r');
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                $csvData[$data[0]] = $data;
            }
        } catch (\Exception $e) {
            throw new \Exception("StorageAdapter: Could not open CSV File!");
        }
        return $csvData;
    }

    protected function hydrateCipherModelFromCsvRow(array $csvRow) : SubstitutionCipherEntity {
        $cipherModel = new SubstitutionCipherEntity();
        $cipherModel->setCipher((string)$csvRow[1]);

        return $cipherModel;
    }
}