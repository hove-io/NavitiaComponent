<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Navitia\Component\Request\Parameters;

use Navitia\Component\AbstractFactory;

/**
 * Description of CoverageParametersFactory
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageParametersFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('parameters');
        $this->setPrefix('coverage');
    }
}
