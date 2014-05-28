<?php

namespace OneRing\Rule;

interface RuleInterface
{

    public function __construct($params = null);
    
    public function test($args);

}
