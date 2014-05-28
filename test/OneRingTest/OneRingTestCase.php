<?php

namespace OneRingTest;



class OneRingTestCase extends \PHPUnit_Framework_TestCase
{

    public function assertRulesPass($test, $args)
    {
        $this->assertTrue($test->passes($args));
    }

    public function assertRulesFail($test, $args)
    {
        $this->assertFalse($test->passes($args));
    }
}
