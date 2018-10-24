<?php

declare(strict_types=1);

namespace Cap\Drivers\StorageDriver;

use Cap\Adapters\CipherStorageAdapterInterface;
use Cap\Adapters\CipherModel;

class FileStorageDriver implements CipherStorageAdapterInterface
{
    const CSV_FIELDS = array("id" => 0, "cipher" => 1, "notes" => 2);

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

    protected function hydrateCipherModelFromCsvRow(array $csvRow) : CipherModel
    {
        $id = (int)$csvRow[self::CSV_FIELDS['id']];
        $cipher = (string)$csvRow[self::CSV_FIELDS['cipher']];
        $notes = (string)$csvRow[self::CSV_FIELDS['notes']];

        $cipherModel = new CipherModel();
        $cipherModel->setId($id);
        $cipherModel->setCipher($cipher);
        $cipherModel->setNotes($notes);

        return $cipherModel;
    }
}