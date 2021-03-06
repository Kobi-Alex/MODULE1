<?php

use PHPUnit\Framework\TestCase;

class getGroupByTagTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected,  groupByTag($input));
    }
        
    public function positiveDataProvider()
    {
        return[

            [
                [
                    ['name'=>'potato','tags'=>['vegetable', 'yellow']],
                    ['name'=>'apple','tags'=>['fruit', 'green']],
                    ['name'=>'orange','tags'=>['fruit', 'yellow']]  
                ],
                [
                    'fruit'=>['apple', 'orange'],
                    'green'=>['apple'],
                    'vegetable'=>['potato'],
                    'yellow'=>['orange', 'potato']
                ]
            ],
        
            [
                [
                    ['name' => 'Php for the Web: Visual QuickStart Guide', 'tags'=> ['php', 'mySql']],
                    ['name' => 'Modern Php: New Features and Good Practices', 'tags'=> ['php']],
                    ['name' => 'Learning php, mySql & javaScript', 'tags'=> ['php', 'mySql', 'javaScript']]
                ],
                [
                    'javaScript' => ['Learning php, mySql & javaScript'],
                    'mySql' => ['Learning php, mySql & javaScript', 'Php for the Web: Visual QuickStart Guide'],
                    'php' => ['Learning php, mySql & javaScript', 'Modern Php: New Features and Good Practices', 'Php for the Web: Visual QuickStart Guide']
                ]
            ]
        ];
    }
}