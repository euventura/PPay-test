<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class AsaasApiException extends Exception
{
    public function __construct($body)
    {
        throw ValidationException::withMessages(array_column($body['errors'], 'description'));
    }
}
