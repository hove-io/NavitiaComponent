<?php

/*
 * RequestProcessorInterface
 */

namespace Navitia\Component\Request\Processor;

use Navitia\Component\Request\NavitiaRequestInterface;

/**
 * Description of RequestProcessorInterface
 *
 * @author rndiaye
 */
interface RequestProcessorInterface
{
    /**
     * Convertit en object NavitiaRequestInterface
     * @throws Exception
     * @return NavitiaRequestInterface
     */
    public function convertToObjectRequest($query);
}
