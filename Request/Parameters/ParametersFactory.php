<?php

namespace Navitia\Component\Request\Parameters;

use Navitia\Component\AbstractFactory;

/**
 * Description of ParametersFactory
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ParametersFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('parameters');
    }
}
