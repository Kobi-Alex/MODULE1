<?php

use PHPUnit\Framework\TestCase;

class getDoubleLineStringTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($line, $expected)
    {
        $this->assertEquals($expected, doubleLineString($line));
    }
        
    public function positiveDataProvider()
    {
        return[

            ["dolphin", "The Dolphin"],
            ["alaska", "Alaskalaska"],
            ["europe", "Europeurope"],
            ["proper", "The Proper"],
            ["africa", "Africafrica"],
        ];
    }
}