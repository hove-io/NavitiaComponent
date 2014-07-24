<?php

namespace Navitia\Component\Exception;

class NavitiaNotFoundException extends NavitiaException implements ExceptionInterface
{
    private $errorNavitia;

    public function __construct($message, $code, $errorNavitia = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errorNavitia = $errorNavitia;
    }

    public function getErrorNavitia() {
        return $this->errorNavitia;
    }

    public function setErrorNavitia($errorNavitia) {
        $this->errorNavitia = $errorNavitia;
    }
}