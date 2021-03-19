<?php

use PHPUnit\Framework\TestCase;
use src\oop\Commands\PowCommand;

class PowCommandTest extends TestCase
{
    /**
     * @var MultCommand
     */
    private $command;

    /**
     * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
     *
     * @inheritdoc
     */
    public function setUp(): void
    {
        $this->command = new PowCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [2, 5, 32],
            [-8, 1/3, -2],
            [8, 1/3, 2],
            ['5', 3, 125],
            [27, 1/3, 3],
            [81, 0.5, 9],
            [3, 0, 1],
            [8, 2/3, 4],
            [4, -0.5, 0.5],
            [-32, 1/5, -2]
        ];
    }

    /**
     * @dataProvider commandPositiveDataProvider
     */
    public function testCommandPositive($a, $b, $expected)
    {
        $result = $this->command->execute($a, $b);

        $this->assertEquals($expected, $result);
    }

    public function testCommandNegative()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->command->execute(0.1);
    }

    /**
     * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
     *
     * @inheritdoc
     */
    public function tearDown(): void
    {
        unset($this->command);
    }
}