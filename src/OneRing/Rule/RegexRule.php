<?php

namespace OneRing\Rule;

class RegexRule extends AbstractRule implements RuleInterface
{

    public function test($args) {
        foreach ( $args as $arg ) {
            if ( preg_match($this->params[0], $arg) ) {
                return true;
            }
        }

        return false;

    }

}
