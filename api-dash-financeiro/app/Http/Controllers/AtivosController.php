<?php

namespace App\Http\Controllers;

use App\Services\AtivosService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Exceptions\AtivosNaoEncontradosException;
use Illuminate\Validation\ValidationException;

class AtivosController extends Controller
{
    protected $ativosService;

    public function __construct(AtivosService $ativosService)
    {
        $this->ativosService = $ativosService;
    }
    public function listarAtivos(): JsonResponse
    {
        try{
            $ativos = $this->ativosService->listarAtivos();
        } catch(AtivosNaoEncontradosException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
        
        return response()->json(['ativos' => $ativos]);
    }

    public function novoAtivo(Request $request): JsonResponse
    {
        try{

            $validaDados = $request->validate([
                'nome' => 'required|string|max:200',
                'tipo' => 'required|string|max:200',
                'valor_unitario' => ['required', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/']
            ]);

            $ativo = $this->ativosService->inserirNovoAtivo($validaDados);

            return response()->json([
                'mensagem' => 'Ativo criado com sucesso!',
            ], 201);

        } catch(ValidationException $e) {

            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);

        }
    }

    public function editarAtivo(Request $request, $id)
    {
        try {
  
            $validatedData = $request->validate([
                'nome' => 'required|string|max:200',
                'tipo' => 'required|string|max:200',
                'valor_unitario' => ['required', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
            ]);

            $ativo = $this->ativosService->atualizarAtivo($id, $validatedData);

            return response()->json([
                'message' => 'Ativo atualizado com sucesso!',
                'ativo' => $ativo
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);

        } catch (AtivosNaoEncontradosException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function deletarAtivo($id)
    {
        try {
            
            $this->ativosService->deletarAtivo($id);
            
            return response()->json([
                'message' => 'Ativo deletado com sucesso!'
            ], 200);

        } catch (AtivosNaoEncontradosException $e) {            
            return response()->json(['error' => $e->getMessage()], 404);        
        }
    }
    
}
