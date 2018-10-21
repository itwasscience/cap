<?php
/**
 * Created by PhpStorm.
 * User: zoey
 * Date: 10/21/18
 * Time: 5:33 PM
 */

use Cap\Adapters\StorageAdapter\CipherModel;
use PHPUnit\Framework\TestCase;

class CipherModelTest extends TestCase
{

    public function testGetAndSetId_whenValidData_expectEquals()
    {
        $cipherModel = new CipherModel();
        $cipherModel->setId(1);
        $this->assertEquals(1, $cipherModel->getId());

    }

    public function testGetAndSetNotes_whenValidData_expectEquals()
    {
        $cipherModel = new CipherModel();
        $cipherModel->setNotes("Some Test Notes");
        $this->assertEquals("Some Test Notes", $cipherModel->getNotes());
    }

    public function testGetAndSetCipher_whenValidData_expectEquals()
    {
        $cipherModel = new CipherModel();
        $cipherModel->setCipher("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        $this->assertEquals("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $cipherModel->getCipher());
    }

    public function testSetId_whenInvalidDataType_expectTypeError()
    {
        $this->expectException(\TypeError::class);
        $cipherModel = new CipherModel();

        $cipherModel->setId(array()); // Throw type error here
    }

    public function testSetNotes_whenInvalidDataType_expectTypeError()
    {
        $this->expectException(\TypeError::class);
        $cipherModel = new CipherModel();

        $cipherModel->setNotes(array()); // Throw type error here
    }

    public function testSetCipher_whenInvalidDataType_expectTypeError()
    {
        $this->expectException(\TypeError::class);
        $cipherModel = new CipherModel();

        $cipherModel->setNotes(array()); // Throw type error here
    }
}
