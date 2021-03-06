<?php

use PHPUnit\Framework\TestCase;

class getCountArgumentsTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($input, $expected){
        $this->assertEquals($expected, countArguments(...$input));
    }

    public function positiveDataProvider(){
        return[
           [ [], ['argument_count' => 0, 'argument_values' => [] ]],
           [ ['string'], ['argument_count' => 1, 'argument_values' => ['string'] ]],
           [ ['string', 2], ['argument_count' => 2, 'argument_values' => ['string', 2] ]],
           [ ['string', true, 45], ['argument_count' => 3, 'argument_values' => ['string', true, 45] ]]
        ];
    }
}