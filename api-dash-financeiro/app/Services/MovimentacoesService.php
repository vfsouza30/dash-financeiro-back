<?php
namespace App\Services;

use App\Models\Movimentacao;
use App\Models\Usuario;
use App\Models\Aplicacao;

use App\Exceptions\UsuarioNaoEncontradoException;

class MovimentacoesService
{
    public function saldoPorUsuario($usuario_id) : int
    {
        if(!Usuario::find($usuario_id)){
            throw new UsuarioNaoEncontradoException();
        }
        
        $entradas = Movimentacao::where('usuario_id', $usuario_id)
                            ->where('situacao', 'E')
                            ->sum('quantidade');

        $saidas = Movimentacao::where('usuario_id', $usuario_id)
        ->where('situacao', 'S')
        ->sum('quantidade');

        if($saidas > $entradas) {
            return -1;
        }

        $saldo = $entradas - $saidas;
        return $saldo;
    }

    public function movimentacoesPorMes($usuario_id, $mes) : array
    {
        if(!Usuario::find($usuario_id)){
            throw new UsuarioNaoEncontradoException();
        }

        $entradas = Movimentacao::whereMonth('created_at', $mes)
                                ->where('usuario_id', $usuario_id)  
                                ->where('situacao', 'E')
                                ->count();

        $saidas = Movimentacao::whereMonth('created_at', $mes)
                              ->where('usuario_id', $usuario_id) 
                              ->where('situacao', 'S')
                              ->count();

        $total_movimentacoes = $entradas + $saidas;

        $dados = [
            'compras' => $entradas,
            'vendas' => $saidas,
            'total_movimentacoes' => $total_movimentacoes
        ];
        return $dados;
    }

    public function novaMovimentacao($movimentacao) : void
    {
        Movimentacao::create($movimentacao);

        $aplicacao = Aplicacao::where('ativo_id', $movimentacao['ativo_id'])
        ->where('usuario_id', $movimentacao['usuario_id'])
        ->where('empresa_id', $movimentacao['empresa_id'])
        ->first();

        if($movimentacao['situacao'] == 'S'){

            if($aplicacao && $aplicacao->quantidade > 0){

                $aplicacao->quantidade -= $movimentacao['quantidade'];
                $aplicacao->valor_total -= $movimentacao['valor_negociacao'];

                $aplicacao->quantidade = max($aplicacao->quantidade, 0);
                $aplicacao->valor_total = max($aplicacao->valor_total, 0);

                $aplicacao->save();
            }

        }else{

            if($aplicacao){

                $aplicacao->quantidade += $movimentacao['quantidade'];
                $aplicacao->valor_total += $movimentacao['valor_negociacao'];
                

            } else{

                $aplicacao = new Aplicacao([
                    'ativo_id' => $movimentacao['ativo_id'],
                    'quantidade' => $movimentacao['quantidade'],
                    'valor_total' => $movimentacao['valor_negociacao'],
                    'empresa_id' => $movimentacao['empresa_id'],
                    'usuario_id' => $movimentacao['usuario_id'],
                ]);
            }

            $aplicacao->save();
        }
    }
}