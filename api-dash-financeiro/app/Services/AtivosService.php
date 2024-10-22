<?php
namespace App\Services;

use App\Exceptions\UsuarioNaoEncontradoException;
use App\Exceptions\AtivosNaoEncontradosException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Ativo;
use App\Models\Usuario;

class AtivosService
{
    public function listarAtivosComRentabilidade($usuario_id, $perPage = 10): object
    {
        if (!Usuario::find($usuario_id)) {
            throw new UsuarioNaoEncontradoException();
        }

        $ativos = Ativo::join('aplicacoes as ap', 'ativos.id', '=', 'ap.ativo_id')
            ->where('ap.usuario_id', $usuario_id)
            ->whereNull('deleted_at')
            ->select(
                'ativos.id',
                'ativos.nome as nome_ativo',
                'ativos.ultimo_preco',
                DB::raw('SUM(ap.valor_total) as valor_atual'),
                DB::raw('(ativos.ultimo_preco * SUM(ap.quantidade)) as valor_antigo'),
                DB::raw('ROUND((((ativos.ultimo_preco * SUM(ap.quantidade)) - SUM(ap.valor_total)) / (ativos.ultimo_preco * SUM(ap.quantidade))) * 100, 2) as rentabilidade')
            )
            ->groupBy('ativos.id', 'nome_ativo', 'ativos.ultimo_preco')
            ->paginate($perPage);

            $ativos->getCollection()->transform(function ($ativo) {
                return [
                    'nome_ativo' => $ativo->nome_ativo,
                    'rentabilidade' => $ativo->rentabilidade,
                ];
            });

        return $ativos;
    }

    public function listarAtivos(): Collection
    {
        $ativos = Ativo::whereNull('deleted_at')->get();

        if($ativos->isEmpty()){
            throw new AtivosNaoEncontradosException();
        }

        return $ativos;
    }

    public function inserirNovoAtivo($dados_ativos): void
    {
        $ativo_save = [
            'nome' => $dados_ativos['nome'],
            'tipo' => $dados_ativos['tipo'],
            'valor_unitario' => $dados_ativos['valor_unitario'],
            'ultimo_preco' => $dados_ativos['valor_unitario'],
        ];

        $ativo = Ativo::create($ativo_save);
    }

    public function atualizarAtivo($id, $dados_ativos): void
    {
        $ativo = Ativo::findOrFail($id);

        if($ativo == null){
            throw new AtivosNaoEncontradosException();
        }

        $dados_update = [
            'nome' => $dados_ativos['nome'],
            'tipo' => $dados_ativos['tipo'],
            'valor_unitario' => $dados_ativos['valor_unitario'],
            'ultimo_preco' => $ativo->valor_unitario != $dados_ativos['valor_unitario'] ? $ativo->valor_unitario : $ativo->ultimo_preco
        ];

        $ativo->update($dados_update);

    }

    public function deletarAtivo($id): void
    {
        $ativo = Ativo::findOrFail($id);

        if($ativo == null){
            throw new AtivosNaoEncontradosException();
        }

        $ativo->delete();
    }
}