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
     */
    public function generateRequest($api): NavitiaRequestInterface;

    /**
     * Fonction permettant de faire l'appel Navitia
     */
    public function callApi(NavitiaRequestInterface $request, ?string $format);
}
