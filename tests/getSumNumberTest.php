<?php

use PHPUnit\Framework\TestCase;

class getSumNumberTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($number, $expected)
    {
        $this->assertEquals($expected, checkNumber($number));
    }
        
    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);
        checkNumber('1234567');
    }

    public function positiveDataProvider()
    {
        return[
            ['123321', true],
            ['786541', false],
            ['123456', false],
            ['333009', true],
            ['000000', true],
            ['001001', true],
        ];
    }
}