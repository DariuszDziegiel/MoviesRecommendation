<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Application\Exception\ApplicationException;

class AlgorithmWithGivenIdNotExistsException extends ApplicationException
{
    public $message = 'Algorithm with given id not exists';
}
