<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Cap\Domains\SubstitutionCipherEntity;

final class SubstitutionCipherEntityTest extends TestCase
{
    public function testSubstitute_givenValidArgumentsWithAsciiInput_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->substitute("ABCDEFGHIJKLMNOPQRSTUVWXYZ", "ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $this->assertEquals("ZYXWVUTSRQPONMLKJIHGFEDCBA", $result);
    }

    public function testSubstitute_givenValidArgumentsWithWhitespace_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->substitute("The quick brown fox jumps over the lazy dog", "ZYXWVUTSRQPONMLKJIHGFEDCBA");

        $this->assertEquals("GSV JFRXP YILDM ULC QFNKH LEVI GSV OZAB WLT", $result);
    }

    public function testSubstitute_givenValidArgumentsWithUnicode_thenExpectedResult() {
        $cipher = new SubstitutionCipherEntity();
        $result = $cipher->substitute("ABCDEFGHIJKLMNOPQRSTUVWXYZ", "恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀");

        $this->assertEquals("恩嫻圀僥鰯狹忰勁摎朴亥模馭稀誣賎堅懺伍网渣閤畏撮請汀", $result);
    }

    /**
     * The cipher string must be exactly 26 unicode graphemes in length.
     */
    public function testSubstitute_givenInvalidCipherString_thenException() {
        $this->expectException(InvalidArgumentException::class);

        $cipher = new SubstitutionCipherEntity();
        $cipher->substitute("Test String", "ZYXWVUTSRQPON"); // 13 replacements defined - Exception!
    }

}
