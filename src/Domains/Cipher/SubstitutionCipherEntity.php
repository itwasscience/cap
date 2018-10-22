<?php

declare(strict_types=1);

namespace Cap\Domains\Cipher;

class SubstitutionCipherEntity implements CipherImplementation
{
    const ENGLISH_ALPHABET_LENGTH = 26;
    const ENGLISH_ALPHABET_ARRAY = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

    public function decode(string $inputString, string $cipherString) : string {
        $this->validateCipherString($cipherString);
        $swapMap = $this->buildDecodeSwapMap($cipherString);
        $resultString = $this->swapUnicodeCharacters($inputString, $swapMap);

        return $resultString;
    }

    public function encode(string $inputString, string $cipherString) : string {
        $this->validateCipherString($cipherString);

        $upperCasedInput = mb_convert_case($inputString, MB_CASE_UPPER, "UTF-8");
        $swapMap = $this->buildEncodeSwapMap($cipherString);
        $resultString = $this->swapUnicodeCharacters($upperCasedInput, $swapMap);

        return $resultString;
    }

    protected function swapUnicodeCharacters(string $inputString, array $swapMap) : string {
        $inputStringArray =  $this->splitUnicodeString($inputString);
        $resultString = '';

        foreach ($inputStringArray as $character) {
            if (isset($swapMap[$character])) {
                $resultString .= $swapMap[$character];
            } else {
                $resultString .= $character;
            }
        }

        return $resultString;
    }

    protected function buildEncodeSwapMap(string $cipherString) : array {
        $cipherCharacterArray = $this->splitUnicodeString($cipherString);
        return array_combine(self::ENGLISH_ALPHABET_ARRAY, $cipherCharacterArray);
    }

    protected function buildDecodeSwapMap(string $cipherString) : array {
        $cipherCharacterArray = $this->splitUnicodeString($cipherString);
        return array_combine($cipherCharacterArray, self::ENGLISH_ALPHABET_ARRAY);
    }

    protected function validateCipherString(string $cipherString) : void {
        if (self::ENGLISH_ALPHABET_LENGTH !== mb_strlen($cipherString)) {
            throw new \InvalidArgumentException("Cipher input string must contain exactly 26 unicode characters.");
        }
    }

    protected function splitUnicodeString($inputString) : array {
        return preg_split('//u', $inputString, -1, PREG_SPLIT_NO_EMPTY);
    }
}