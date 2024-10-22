<?php

namespace App\Exceptions;

use Exception;

class AtivosNaoEncontradosException extends Exception
{
    protected $message = 'Ativos não encontrados';
}
