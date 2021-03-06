<?php

use PHPUnit\Framework\TestCase;

class getSayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($arg, $expected){
        $this->assertEquals($expected, sayHelloArgument($arg));
    }
        
    public function positiveDataProvider(){
        return[
            ["world", "Hello world"],
            ["21111", "Hello 21111"],
            [1234, "Hello 1234"],
            [true, "Hello 1"],
            [false, "Hello "],
            [1234.34, "Hello 1234.34"]
        ];
    }
}