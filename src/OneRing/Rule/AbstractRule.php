<?php

namespace OneRing\Rule;

abstract class AbstractRule
{
    protected $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }

}
