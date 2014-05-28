<?php

namespace OneRingTest;

use \OneRing\OneRing;
use \OneRing\Rule\InArrayRule;

class InArrayTest extends OneRingTestCase
{

    public function test_in_array_rule() {
        $test = new OneRing();
        $test->test(new InArrayRule('one', 'two', 'three'));

        $this->assertRulesPass($test, array('one'));
        $this->assertRulesFail($test, array('four'));
    }

}
