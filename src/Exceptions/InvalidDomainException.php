<?php
namespace Sysborg\CheckMyDomain\Exceptions;

use Exception;

class InvalidDomainException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @return void
     */
    public function __construct(string $message = 'Invalid domain provided.')
    {
        parent::__construct($message);
    }
}