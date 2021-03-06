<?php

use PHPUnit\Framework\TestCase;

class getSayHelloTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($expected){
        $this->assertEquals($expected, sayHello());
    }
        
    public function positiveDataProvider(){
        return[
            ['Hello']
        ];
    }
}