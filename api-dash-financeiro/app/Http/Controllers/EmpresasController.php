<?php

namespace App\Http\Controllers;

use App\Services\EmpresasService;
use Illuminate\Http\JsonResponse;

use App\Exceptions\UsuarioNaoEncontradoException;

class EmpresasController extends Controller
{
    protected $empresasService;

    public function __construct(EmpresasService $empresasService)
    {
        $this->empresasService = $empresasService;
    }

    public function carteiraUsuario($usuario_id): JsonResponse
    {
        try{

            $total_empresas = $this->empresasService->TotalEmpresasPorUsuario($usuario_id);
        } catch(UsuarioNaoEncontradoException $e){
            return response()->json(['error' => $e->getMessage()], 404);
        }

        if($total_empresas === -1){
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        return response()->json(['total_empresas' => $total_empresas]);
    }
}
