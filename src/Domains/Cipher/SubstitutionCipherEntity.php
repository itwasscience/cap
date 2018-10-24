<?php

declare(strict_types=1);

namespace Cap\Domains\Cipher;

class SubstitutionCipherEntity
{
    const ENGLISH_ALPHABET_LENGTH = 26;
    const ENGLISH_ALPHABET_ARRAY = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
        "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    protected $cipher;

    public function setCipher(string $cipher) : self {
        $this->cipher = $cipher;
        return $this;
    }

    public function getCipher() : string {
        return $this->cipher;
    }

    public function decode(string $encryptedString): string
    {
        $this->validateCipherString();
        $swapMap = $this->buildDecodeSwapMap();
        $resultString = $this->swapUnicodeCharacters($encryptedString, $swapMap);

        return $resultString;
    }

    public function encode(string $plainTextString): string
    {
        $upperCasedInput = mb_convert_case($plainTextString, MB_CASE_UPPER, "UTF-8");

        $this->validateCipherString();
        $swapMap = $this->buildEncodeSwapMap();
        $resultString = $this->swapUnicodeCharacters($upperCasedInput, $swapMap);

        return $resultString;
    }

    protected function swapUnicodeCharacters(string $inputString, array $swapMap): string
    {
        $inputStringArray = $this->splitUnicodeString($inputString);
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

    protected function buildEncodeSwapMap(): array
    {
        $cipherCharacterArray = $this->splitUnicodeString($this->cipher);
        return array_combine(self::ENGLISH_ALPHABET_ARRAY, $cipherCharacterArray);
    }

    protected function buildDecodeSwapMap(): array
    {
        $cipherCharacterArray = $this->splitUnicodeString($this->cipher);
        return array_combine($cipherCharacterArray, self::ENGLISH_ALPHABET_ARRAY);
    }

    protected function validateCipherString(): void
    {
        if (self::ENGLISH_ALPHABET_LENGTH !== mb_strlen($this->cipher)) {
            throw new \InvalidArgumentException("Cipher input string must contain exactly 26 unicode characters.");
        }
    }

    protected function splitUnicodeString($inputString): array
    {
        return preg_split('//u', $inputString, -1, PREG_SPLIT_NO_EMPTY);
    }
}