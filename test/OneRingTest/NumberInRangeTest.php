<?php

namespace OneRingTest;

use \OneRing\OneRing;
use \OneRing\Rule\NumberInRangeRule;

class NumberInRangeTest extends OneRingTestCase
{

    public function test_number_in_range_rule() {
        $test = new OneRing();
        $test->test(new NumberInRangeRule(array(5, 10)));

        $this->assertRulesPass($test, array(6));
        $this->assertRulesFail($test, array(11));
    }

}
