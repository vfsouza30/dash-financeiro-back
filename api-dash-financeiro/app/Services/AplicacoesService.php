<?php
namespace App\Services;

use App\Models\Aplicacao;
use App\Models\Usuario;

use App\Exceptions\UsuarioNaoEncontradoException;

class AplicacoesService
{
    public function distribuicaoAtivos($usuario_id) : array
    {
        if(!Usuario::find($usuario_id)){
            throw new UsuarioNaoEncontradoException();
        }
        
        $ativos = Aplicacao::where('aplicacoes.usuario_id', $usuario_id)
            ->join('ativos as aa', 'aplicacoes.ativo_id', '=', 'aa.id')
            ->selectRaw('aa.nome as nome_ativo, sum(aplicacoes.quantidade) as quantidade')
            ->whereNull('aa.deleted_at')
            ->groupBy('aa.nome')
            ->orderBy('aa.nome')
            ->pluck('quantidade', 'nome_ativo')
            ->toArray();

        return $ativos;
    }
}