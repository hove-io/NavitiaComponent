<?php

namespace Navitia\Component\Exception;

class NavitiaException extends \Exception implements ExceptionInterface
{
    protected $exceptions;
    protected $notes;
    
    public function getExceptions()
    {
        return $this->exceptions;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setExceptions(array $exceptions)
    {
        $this->exceptions = $exceptions;
    }

    public function setNotes(array $notes)
    {
        $this->notes = $notes;
    }
}
