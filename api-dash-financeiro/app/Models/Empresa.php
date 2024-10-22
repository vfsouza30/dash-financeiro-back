<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    
    use HasFactory;

    protected $fillable = [
        'nome',
        'usuario_id',
    ];

    public function aplicacoes()
    {
        return $this->hasMany(Aplicacao::class, 'empresa_id');
    }
    
}
