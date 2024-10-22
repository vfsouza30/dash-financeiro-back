<?php
namespace App\Services;

use App\Models\Empresa;
use App\Models\Usuario;

use App\Exceptions\UsuarioNaoEncontradoException;

class EmpresasService
{
    public function TotalEmpresasPorUsuario($usuario_id) : int
    {
        if(!Usuario::find($usuario_id)){
            throw new UsuarioNaoEncontradoException();
        }
        
        $total_empresas = Empresa::where('usuario_id', $usuario_id)->count();

        return $total_empresas;
    }
}