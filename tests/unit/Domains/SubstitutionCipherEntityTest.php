<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cap\Domains\Cipher\SubstitutionCipherEntity;

final class SubstitutionCipherEntityTest extends TestCase
{
    public function testEncode_givenValidArgumentsWithAsciiInput_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->encode("ABCDEFGHIJKLMNOPQRSTUVWXYZ", "ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $this->assertEquals("ZYXWVUTSRQPONMLKJIHGFEDCBA", $result);
    }

    public function testEncode_givenValidArgumentsWithWhitespace_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->encode("The quick brown fox jumps over the lazy dog", "ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $this->assertEquals("GSV JFRXP YILDM ULC QFNKH LEVI GSV OZAB WLT", $result);
    }

    public function testEncode_givenValidArgumentsWithUnicode_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->encode("ABCDEFGHIJKLMNOPQRSTUVWXYZ", "恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀");

        $this->assertEquals("恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀", $result);
    }

    /**
     * The cipher string must be exactly 26 unicode graphemes in length.
     */
    public function testEncode_givenInvalidCipherString_thenException() {
        $this->expectException(\InvalidArgumentException::class);

        $cipher = new SubstitutionCipherEntity();
        $cipher->encode("Test String", "ZYXWVUTSRQPONV"); // 13 replacements defined - Exception!
    }

    public function testDecode_givenValidArgumentsWithAsciiInput_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->decode("ZYXWVUTSRQPONMLKJIHGFEDCBA", "ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $this->assertEquals("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $result);
    }

    public function testDecode_givenValidArgumentsWithWhitespace_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->decode("GSV JFRXP YILDM ULC QFNKH LEVI GSV OZAB WLT", "ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $this->assertEquals("THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG", $result);
    }

    public function testDecode_givenValidArgumentsWithUnicode_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->decode("恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀", "恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀");

        $this->assertEquals("ABCDEFGHIJKLMNOPQRSTUVWXYZ", $result);
    }

    /**
     * The cipher string must be exactly 26 unicode graphemes in length.
     */
    public function testDecode_givenInvalidCipherString_thenException() {
        $this->expectException(\InvalidArgumentException::class);

        $cipher = new SubstitutionCipherEntity();
        $cipher->decode("Test String", "ZYXWVUTSRQPONV"); // 13 replacements defined - Exception!
    }
}
