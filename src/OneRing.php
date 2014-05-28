<?php

namespace OneRing;

class OneRing
{

    protected $operations = array('and', 'or');

    protected $tests = array();

    public function test($test, $type = 'default') {
        $this->tests[] = array($test, $type);
        return $this;
    }

    public function or_($test) {
        return $this->test($test, 'or');
    }

    public function and_($test) {
        return $this->test($test, 'and');
    }

    public function passes($args) {
        $ok = null;
        $type = 'default';
        foreach ( $this->tests as $test_container ) {
            $test = $test_container[0];
            $type = $test_container[1];
            if ( is_a($test, '\\OneRing\\OneRing') ) {
                $pass = $test->passes($args);
            } else {
                $pass = $test->test($args);
            }
            switch($type) {
                case 'or':
                    if ( $pass ) $ok = true;
                    break;
                case 'and':
                case 'default':
                    if ( !$pass ) {
                        $ok = false;
                    } elseif ( $ok === null ) {
                        $ok = true;
                    }
            }
        }
        return $ok;
    }

    public function parse($data) {
        $this->tests = $this->parseDataIntoTests($data);
        return $this;
    }

    protected function parseDataIntoTests($data) {
        $tests = array();
        if ( !is_array($data) ) {
            $data = array($data);
        }
        foreach ( $data as $key => $value ) {
            if ( is_numeric($key) ) {
                $rule = array(new $value(), 'default');
            } else {
                if ( $this->isOperation($key) ) {
                    if ( !is_array($value) ) {
                        $value = array($value);
                    }
                    foreach ( $value as $v ) {
                        $child = new OneRing();
                        $child->parse($v);
                        $rule = array($child, $key);
                    }
                } else {
                    $rule = array(new $key($value), 'default');
                }
            }
            $tests[] = $rule;
        }
        return $tests;
    }

    protected function isOperation($key) {
        return (array_search($key, $this->operations) !== false);
    }


}
