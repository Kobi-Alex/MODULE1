<?php

use PHPUnit\Framework\TestCase;

class getCountArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($input, $expected){
        $this->assertEquals($expected,  countArgumentsWrapper(...$input));
    }
    public function testNegative(){
        $this->expectException(InvalidArgumentException::class);

        $input = ["string", 1, 'c'];
        countArgumentsWrapper(...$input);
    }

    public function positiveDataProvider(){
        return null;
    }
}