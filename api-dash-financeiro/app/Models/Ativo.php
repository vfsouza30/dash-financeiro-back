<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ativo extends Model
{
    protected $table = 'ativos';

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'tipo',
        'valor_unitario',
        'ultimo_preco',
    ];

    public function aplicacoes()
    {
        return $this->hasMany(Aplicacao::class, 'ativo_id');
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'ativo_id');
    }
}
