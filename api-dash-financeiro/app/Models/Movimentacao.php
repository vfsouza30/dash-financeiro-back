<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';

    use HasFactory;
    protected $fillable = [
        'ativo_id',
        'empresa_id',
        'usuario_id',
        'situacao',
        'quantidade',
        'valor_negociacao',
    ];

    public function ativo()
    {
        return $this->belongsTo(Ativo::class, 'ativo_id');
    }
}
