<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
    protected $table = 'aplicacoes';

    use HasFactory;
    protected $fillable = [
        'ativo_id',
        'quantidade',
        'valor_total',
        'empresa_id',
        'usuario_id',
    ];

    public function ativo()
    {
        return $this->belongsTo(Ativo::class, 'ativo_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

}
