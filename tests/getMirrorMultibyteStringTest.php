<?php

use PHPUnit\Framework\TestCase;

class getMirrorMultibyteStringTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, mirrorMultibyteString($input) );
    }
        
    public function positiveDataProvider()
    {
        return[

            ['ФЫВАР молорпан арап', 'РАВЫФ напролом пара'],
            ['Поверніть найменше унікальне значення', 'ьтінревоП ешнемйан еньлакіну яннечанз'],
            ['ПНЧ', 'ЧНП'],
            ['значенням без зміни порядку', 'мяннечанз зеб инімз укдяроп'],
            ['АвІфЄ','ЄфІвА']
        ];
    }
}