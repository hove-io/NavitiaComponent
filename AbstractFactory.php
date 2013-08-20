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
    private $prefix = null;
    private $defaultClass = null;

    /**
     * {@inheritDoc}
     */
    public function create($type)
    {
        $name = $this->builClassName($type);
        if (class_exists($name)) {
            return new $name;
        } else {
            if (!is_null($this->getDefaultClass())) {
                $default = $this->getNamespace().'\\'.$this->getDefaultClass();
                if (class_exists($default)) {
                    return new $default;
                }
            }
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
     * Getter du prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Setter du prefix
     *
     * @param string $prefix
     * @return \Navitia\Component\AbstractFactory
     */
    public function setPrefix($prefix)
    {
        $this->prefix = ucfirst($prefix);
        return $this;
    }

    /**
     * Getter d'une class par defaut
     *
     * @return string
     */
    public function getDefaultClass()
    {
        return $this->defaultClass;
    }

    /**
     * Setter d'une class par défaut
     *
     * @param string $defaultClass
     * @return \Navitia\Component\AbstractFactory
     */
    public function setDefaultClass($defaultClass)
    {
        $this->defaultClass = $defaultClass;
        return $this;
    }

    /**
     * Fonction permettant de créer le nom de la class
     *
     * @params string
     * @return string
     */
    private function builClassName($type)
    {
        $name = $this->getNamespace().'\\';
        if (!is_null($this->getprefix())) {
            $name .= $this->getprefix();
        }
        $name .= ucfirst($type).$this->getSuffix();
        return $name;
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
