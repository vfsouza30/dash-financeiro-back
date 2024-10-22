<?php

namespace App\Http\Controllers;

use App\Services\AplicacoesService;
use App\Services\AtivosService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Exceptions\UsuarioNaoEncontradoException;

class AplicacoesController extends Controller
{
    protected $aplicacoesService;
    protected $ativosService;

    public function __construct(AplicacoesService $aplicacoesService, AtivosService $ativosService)
    {
        $this->aplicacoesService = $aplicacoesService;
        $this->ativosService = $ativosService;
    }

    public function distribuicaoAtivos($usuario_id): JsonResponse
    {
        try{
            $ativos = $this->aplicacoesService->distribuicaoAtivos($usuario_id);
        } catch(UsuarioNaoEncontradoException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
        
        return response()->json(['ativos' => $ativos]);
    }

    public function listarAtivosComRentabilidade(Request $request, $usuario_id): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        
        try {
            $ativos = $this->ativosService->listarAtivosComRentabilidade($usuario_id, $perPage);
        } catch (UsuarioNaoEncontradoException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

        return response()->json(['ativos' => $ativos]);
    }
}