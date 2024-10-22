<?php

namespace App\Http\Controllers;

use App\Services\MovimentacoesService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Exceptions\UsuarioNaoEncontradoException;
use App\Exceptions\DataInvalidaException;
use Illuminate\Validation\ValidationException;

class MovimentacoesController extends Controller
{
    protected $movimentacoesService;

    public function __construct(MovimentacoesService $movimentacoesService)
    {
        $this->movimentacoesService = $movimentacoesService;
    }

    public function saldo($usuario_id): JsonResponse
    {
        try{
            $soma = $this->movimentacoesService->saldoPorUsuario($usuario_id);
        } catch(UsuarioNaoEncontradoException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
        
        return response()->json(['soma' => $soma]);
    }

    public function movimentacoesMes($usuario_id, $mes): JsonResponse
    {
        try{
        
            if(!filter_var($mes, FILTER_VALIDATE_INT)){
                throw new DataInvalidaException('Mês inválido, favor informar por número. Ex: Janeiro = 1');
            }

            if($mes < 1 || $mes > 12){
                throw new DataInvalidaException('Mês inválido, favor informar um número entre 1 e 12');
            }

            
            $movimentacoes_mes = $this->movimentacoesService->movimentacoesPorMes($usuario_id, $mes);
        } catch(UsuarioNaoEncontradoException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch(DataInvalidaException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
        return response()->json(
            [
                'mes' => $mes,
                'compras' => $movimentacoes_mes['entradas'], 
                'vendas' => $movimentacoes_mes['saidas'], 
                'total_movimentacoes' => $movimentacoes_mes['total_movimentacoes']
            ]
        );
    }

    public function novoMovimentacoes(Request $request): JsonResponse
    {
        try{

            $validaDados = $request->validate([
                'ativo_id' => 'required|exists:ativos,id',
                'empresa_id' => 'required|exists:empresas,id',
                'usuario_id' => 'required|exists:usuarios,id',
                'situacao' => 'required|string|max:1',
                'quantidade' => 'required|numeric',
                'valor_negociacao' => ['required', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/']
            ]);

            $this->movimentacoesService->novaMovimentacao($validaDados);

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
}
