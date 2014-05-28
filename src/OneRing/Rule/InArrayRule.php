<?php

namespace OneRing\Rule;

class InArrayRule extends AbstractRule implements RuleInterface
{

    public function test($args)
    {
        if ( !is_array($this->params) ) {
            $this->params = array($this->params);
        }
        
        foreach ( $args as $arg ) {
            if ( array_search($arg, $this->params) !== false ) {
                return true;
            }
        }

        return false;
        
    }

}
