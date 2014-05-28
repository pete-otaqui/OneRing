<?php

namespace OneRingTest\Rule;

use \OneRing\Rule\RuleInterface;
use \OneRing\Rule\AbstractRule;

class FailingRule extends AbstractRule implements RuleInterface
{

    public function test($args)
    {
        return false;
    }

}
