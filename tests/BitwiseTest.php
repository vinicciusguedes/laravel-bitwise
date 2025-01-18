<?php

namespace VG\LaravelBitwise\Tests;

use VG\LaravelBitwise\Bitwise;
use PHPUnit\Framework\TestCase;

class BitwiseTest extends TestCase
{
    /**
     * Testa a função addBit
     */
    public function testAddBit()
    {
        $currentValue = 2;  // 0010 em binário
        $bit = 4;  // 0100 em binário

        $result = Bitwise::addBit($currentValue, $bit);

        // Esperamos 6 (0110 em binário), pois 2 | 4 = 6
        $this->assertEquals(6, $result);
    }

    /**
     * Testa a função addBitInArray com key_type = true
     */
    public function testAddBitInArrayKeyTypeTrue()
    {
        $array = [1, 2];
        $bit = 4;

        $result = Bitwise::addBitInArray($array, $bit, true);

        $this->assertContains(4, $result);  // Verifica se o bit foi adicionado
        $this->assertEquals([1, 2, 4], $result);  // Esperado: [1, 2, 4]
    }

    /**
     * Testa a função addBitInArray com key_type = false
     */
    public function testAddBitInArrayKeyTypeFalse()
    {
        $array = [1 => 1, 2 => 2];
        $bit = 4;

        $result = Bitwise::addBitInArray($array, $bit, false);

        $this->assertArrayHasKey(4, $result);  // Verifica se a chave 4 foi adicionada
        $this->assertEquals([1 => 1, 2 => 2, 4 => 4], $result);  // Esperado com chave 4
    }

    /**
     * Testa a função removeBit
     */
    public function testRemoveBit()
    {
        $currentValue = 7;  // 0111 em binário
        $bit = 2;  // 0010 em binário

        $result = Bitwise::removeBit($currentValue, $bit);

        // Esperamos 5 (0101 em binário), pois 7 & ~2 = 5
        $this->assertEquals(5, $result);
    }

    /**
     * Testa a função hasBit
     */
    public function testHasBitTrue()
    {
        $currentValue = 5;  // 0101 em binário
        $bit = 4;  // 0100 em binário

        $result = Bitwise::hasBit($currentValue, $bit);

        $this->assertTrue($result);  // O bit 4 está ativo em 5
    }

    /**
     * Testa a função hasBit para bit não presente
     */
    public function testHasBitFalse()
    {
        $currentValue = 5;  // 0101 em binário
        $bit = 2;  // 0010 em binário

        $result = Bitwise::hasBit($currentValue, $bit);

        $this->assertFalse($result);  // O bit 2 não está ativo em 5
    }

    /**
     * Testa a função hasBitsInArray
     */
    public function testHasBitsInArray()
    {
        $bitValue = 7;  // 0111 em binário
        $bits = [1, 2, 4];

        $result = Bitwise::hasBitsInArray($bitValue, $bits);

        $this->assertTrue($result[1]);  // O bit 1 está presente
        $this->assertTrue($result[2]);  // O bit 2 está presente
        $this->assertTrue($result[4]);  // O bit 4 está presente
    }

    /**
     * Testa a função getActiveBits
     */
    public function testGetActiveBits()
    {
        $value = 7;  // 0111 em binário

        $result = Bitwise::getActiveBits($value);

        $this->assertEquals([1, 2, 4], $result);  // Esperado: [1, 2, 4]
    }

    /**
     * Testa a função sumActiveBits
     */
    public function testSumActiveBits()
    {
        $bits = [1, 2, 4];

        $result = Bitwise::sumActiveBits($bits);

        $this->assertEquals(7, $result);  // 1 + 2 + 4 = 7
    }

    /**
     * Testa a função sortBitsByKey
     */
    public function testSortBitsByKey()
    {
        $bits = [4 => 4, 2 => 2, 1 => 1];

        $result = Bitwise::sortBitsByKey($bits);

        $this->assertEquals([1 => 1, 2 => 2, 4 => 4], $result);  // Esperado: ordenado
    }
}