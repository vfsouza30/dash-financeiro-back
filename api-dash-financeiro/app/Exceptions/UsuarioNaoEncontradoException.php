<?php

namespace App\Exceptions;

use Exception;

class UsuarioNaoEncontradoException extends Exception
{
    protected $message = 'Usuário não encontrado';
}
