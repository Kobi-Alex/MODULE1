<?php

use PHPUnit\Framework\TestCase;

class getCamelCasedTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, camelCased($input));
    }
        
    public function positiveDataProvider()
    {
        return[
            ['this_is_home_task', 'thisIsHomeTask'],
            ['hello_world', 'helloWorld'],
            ['cannot_use_string_offset_as_an_array_in_php', 'cannotUseStringOffsetAsAnArrayInPhp'],
            ['camel_cased','camelCased'],
            ['a_adfdfd','aAdfdfd']
        ];
    }
}