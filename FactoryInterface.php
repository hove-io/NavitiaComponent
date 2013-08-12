<?php

/*
 * FactoryInterface
 */

namespace Navitia\Component;

/**
 *
 * @author rndiaye
 */
interface FactoryInterface
{

    /**
     * Fonction permettant la création d'une Factory
     *
     * @param string $type
     * @return mixed \Navitia\Component\name
     * @throws NavitiaCreationException
     */
    public function create($type);
}
