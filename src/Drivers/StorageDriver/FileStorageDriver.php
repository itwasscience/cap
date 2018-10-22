<?php

declare(strict_types=1);

namespace Cap\Drivers\StorageDriver;

use Cap\Adapters\StorageAdapter\StorageAdapterInterface;
use Cap\Adapters\StorageAdapter\CipherModel;

class FileStorageDriver implements StorageAdapterInterface
{
    const CSV_FIELDS = array("id", "cipher", "notes");

    protected $filename = '';
    protected $csvData = array();

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function findCipherById(int $id): CipherModel
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

    protected function hydrateCipherModelFromCsvRow(array $csvRow) : CipherModel {
        $cipherModel = new CipherModel();
        $cipherModel->setId((int)$csvRow[0]);
        $cipherModel->setCipher($csvRow[1]);
        $cipherModel->setNotes($csvRow[2]);

        return $cipherModel;
    }
}