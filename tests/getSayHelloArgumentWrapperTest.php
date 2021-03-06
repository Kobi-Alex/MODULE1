<?php

use PHPUnit\Framework\TestCase;

class getSayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($arg, $expected){
        $this->assertEquals($expected, sayHelloArgumentWrapper($arg));
    }
    public function testNegative(){
        $this->expectException(InvalidArgumentException::class);
        sayHelloArgumentWrapper ([4, 33]);
    }

    public function positiveDataProvider(){
        return null;
    }
}