<?php

namespace OneRingTest;

use \OneRing\OneRing;
use \OneRingTest\Rule\ExactlyMatchingRule;
use \OneRingTest\Rule\PassingRule;
use \OneRingTest\Rule\FailingRule;
use \OneRingTest\Rule\ReturnFirstArgRule;

class CanCreateRulesTest extends OneRingTestCase
{

    public function test_can_create_a_single_rule()
    {
        $my_test = new OneRing();
        $my_test->test(new PassingRule());

        $this->assertRulesPass($my_test, array());
    }

    public function test_can_create_a_multiple_rule()
    {
        $my_test = new OneRing();

        $my_test
            ->test(new PassingRule())
            ->and_(new PassingRule())
            ->or_(new FailingRule());

        $this->assertRulesPass($my_test, array());
    }

    public function test_can_create_a_multiple_failing_rule()
    {
        $my_test = new OneRing();

        $my_test
            ->test(new PassingRule())
            ->or_(new PassingRule())
            ->and_(new FailingRule());

        $this->assertRulesFail($my_test, array());
    }



    public function test_can_add_child()
    {

        $child_test = new OneRing();
        $child_test
            ->test(new PassingRule())
            ->and_(new PassingRule())
            ->or_(new FailingRule());

        $parent_test = new OneRing();
        $parent_test
            ->test(new PassingRule())
            ->and_($child_test);

        $this->assertRulesPass($parent_test, array());

    }



    public function test_can_add_failing_child()
    {

        $child_test = new OneRing();
        $child_test
            ->test(new PassingRule())
            ->and_(new PassingRule())
            ->and_(new FailingRule());

        $parent_test = new OneRing();
        $parent_test
            ->test(new PassingRule())
            ->and_($child_test);

        $this->assertRulesFail($parent_test, array());

    }


    public function test_can_create_a_dynamic_rule()
    {
        $my_test = new OneRing();

        $my_test->test(new ExactlyMatchingRule(array('yay')));

        $this->assertRulesPass($my_test, array('yay'));
        $this->assertRulesFail($my_test, array('boo'));
    }

}
