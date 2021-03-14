<?php

use PHPUnit\Framework\TestCase;

class getUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($arr, $expected)
    {
        $this->assertEquals($expected,  getUniqueFirstLetters($arr));
    }
        
    public function positiveDataProvider()
    {
        return[
            
            [
                [
                    ["name" => "Albuquerque Sunport International Airport",
                    "code" => "ABQ",
                    "city" => "Albuquerque",
                    "state" => "New Mexico",
                    "address" => "2200 Sunport Blvd, Albuquerque, NM 87106, USA",
                    "timezone" => "America/Los_Angeles"]
                ],
                ['A']
            ]
                
        ];
    }
}