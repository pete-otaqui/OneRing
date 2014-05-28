<?php

namespace OneRing\Rule;

class NumberInRangeRule extends AbstractRule implements RuleInterface
{

    public function test($args) {

        foreach ( $args as $arg ) {
            if ( $arg > $this->params[0] && $arg < $this->params[1] ) {
                return true;
            }
        }

    }

}
