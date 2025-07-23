<?php
namespace Sysborg\CheckMyDomain\Exceptions;

use Exception;

class InvalidPrefixException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @return void
     */
    public function __construct(string $message = 'Invalid prefix provided.')
    {
        parent::__construct($message);
    }
}