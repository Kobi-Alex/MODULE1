<?php

use PHPUnit\Framework\TestCase;

class getLeapYearTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($year, $expected)
    {
        $this->assertEquals($expected, checkLeapYear($year));
    }
        
    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);
        checkLeapYear(1890);
    }

    public function positiveDataProvider()
    {
        return[
            [2000, true],
            [2001, false],
            [2200, false],
            [1995, false],
            [1921, false],
            [2004, true],
            [2021, false]
        ];
    }
}