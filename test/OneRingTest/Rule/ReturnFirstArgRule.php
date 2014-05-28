<?php

namespace OneRingTest\Rule;

use \OneRing\Rule\RuleInterface;
use \OneRing\Rule\AbstractRule;

class ReturnFirstArgRule extends AbstractRule implements RuleInterface
{

    public function test($args)
    {
        return $args[0];
    }

}
