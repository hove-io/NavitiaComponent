<?php

/*
 * RequestFactory
 */

namespace Navitia\Component\Request;

use Navitia\Component\AbstractFactory;

/**
 * Description of RequestFactory
 *
 * @author rndiaye
 */
class RequestFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('request');
    }
}
