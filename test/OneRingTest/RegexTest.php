<?php

namespace OneRingTest;

use \OneRing\OneRing;
use \OneRing\Rule\RegexRule;

class RegexTest extends OneRingTestCase
{

    public function test_regex_rule() {
        $test = new OneRing();
        $test->test(new RegexRule(array('|^he|')));

        $this->assertRulesPass($test, array('hello'));
        $this->assertRulesFail($test, array('said he'));
    }

}
