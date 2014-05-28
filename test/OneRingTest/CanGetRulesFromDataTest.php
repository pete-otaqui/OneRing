<?php

namespace OneRingTest;

use \OneRing\OneRing;
use \OneRingTest\Rule\ExactlyMatchingRule;
use \OneRingTest\Rule\PassingRule;
use \OneRingTest\Rule\FailingRule;
use \OneRingTest\Rule\ReturnFirstArgRule;

class CanGetRulesFromDataTest extends OneRingTestCase
{


    public function test_can_parse_passing_test()
    {
        $test_array = array('\\OneRingTest\\Rule\\PassingRule');

        $my_test = new OneRing();
        $my_test->parse($test_array);

        $this->assertRulesPass($my_test, array());
    }

    public function test_can_parse_failing_test()
    {
        $test_array = array('\\OneRingTest\\Rule\\FailingRule');

        $my_test = new OneRing();
        $my_test->parse($test_array);

        $this->assertRulesFail($my_test, array());
    }

    public function test_can_get_one_set_of_passing_tests()
    {
        $test_array = array(
            'and' => array(
                '\\OneRingTest\\Rule\\PassingRule',
                '\\OneRingTest\\Rule\\PassingRule',
            )
        );

        $my_test = new OneRing();
        $my_test->parse($test_array);


        $this->assertRulesPass($my_test, array());
    }



    public function test_can_get_one_set_of_failing_tests()
    {
        $test_array = array(
            'and' => array(
                '\\OneRingTest\\Rule\\PassingRule',
                '\\OneRingTest\\Rule\\FailingRule',
            )
        );

        $my_test = new OneRing();
        $my_test->parse($test_array);

        $this->assertRulesFail($my_test, array());
    }

    public function test_can_get_multiple_sets_of_tests()
    {
        $test_array = array(
            'and' => array(
                '\\OneRingTest\\Rule\\PassingRule',
                array(
                    'or' => array(
                        '\\OneRingTest\\Rule\\FailingRule',
                        '\\OneRingTest\\Rule\\PassingRule',
                    )
                )
            )
        );

        $my_test = new OneRing();
        $my_test->parse($test_array);
        $this->assertRulesPass($my_test, array());
    }


    public function test_can_add_tests_to_loaded_sets()
    {
        $test_array = array(
            'and' => array(
                '\\OneRingTest\\Rule\\PassingRule',
                array(
                    'or' => array(
                        '\\OneRingTest\\Rule\\FailingRule',
                        '\\OneRingTest\\Rule\\PassingRule',
                    )
                )
            )
        );

        $my_test = new OneRing();
        $my_test
            ->parse($test_array)
            ->and_(new PassingRule());

        $this->assertRulesPass($my_test, array());

        $my_test
            ->and_(new FailingRule());

        $this->assertRulesFail($my_test, array());
    }

    public function test_can_create_tests_that_depend_on_dynamic_data()
    {
        $test_array = array(
            '\\OneRingTest\\Rule\\ExactlyMatchingRule' => array('WIN'),
        );

        $my_test = new OneRing();
        $my_test->parse($test_array);

        $this->assertRulesPass($my_test, array('WIN'));
        $this->assertRulesFail($my_test, array('LOSE'));

    }

}
