<?php

/*
 * NavitiaServiceInterface
 */

namespace Navitia\Component\Service;

use Navitia\Component\Request\NavitiaRequestInterface;

/**
 * Description of NavitiaServiceInterface
 *
 * @author rndiaye
 */
interface NavitiaServiceInterface
{
    /**
     * Generateur des Request
     *
     * @param type $api
     * @return \Navitia\Component\Request\NavitiaRequestInterface
     */
    public function generateRequest($api);

    /**
     * Fonction permettant de faire l'appel Navitia
     *
     * @param \Navitia\Component\Request\NavitiaRequestInterface $request
     * @param mixed $format
     * @return mixed
     */
    public function callApi(NavitiaRequestInterface $request, $format);
}
