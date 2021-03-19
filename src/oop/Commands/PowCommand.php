<?php

namespace src\oop\Commands;

class PowCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        $result = null;
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enougph parameters');
        }

        if ($args[0] < 0 && $args[1] > 0) {
            if ((1/$args[1]) %2 != 0) {
                $args[0] = abs($args[0]);
                $sign = -1;
                return $args[0]**$args[1] * $sign;
            } else if ((1/$args[1]) %2 == 0) {
                throw new \InvalidArgumentException('Incorrect powder!!');
            }
        } else {
            return $args[0]**$args[1];
        }
    }
}