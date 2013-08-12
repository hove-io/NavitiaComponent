<?php

/*
 * AbstractFactory
 */

namespace Navitia\Component;

use Navitia\Component\Exception\NavitiaCreationException;

/**
 * Description of AbstractFactory
 *
 * @author rndiaye
 */
class AbstractFactory implements FactoryInterface
{
    private $suffix;

    /**
     * {@inheritDoc}
     */
    public function create($type)
    {
        $name = $this->getNamespace().'\\';
        $name .= ucfirst($type).$this->getSuffix();
        if (class_exists($name)) {
            return new $name;
        } else {
            throw new NavitiaCreationException(
                sprintf(
                    'Class "%s" not found',
                    $name
                )
            );
        }
    }

    /**
     * Getter du suffix
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Setter du suffix
     *
     * @param string $suffix
     * @return \Navitia\Component\AbstractFactory
     */
    public function setSuffix($suffix)
    {
        $this->suffix = ucfirst($suffix);
        return $this;
    }

    /**
     * Recupération du namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        $currentClass = get_class($this);
        $reflector = new \ReflectionClass($currentClass);
        return $reflector->getNamespaceName();
    }
}
