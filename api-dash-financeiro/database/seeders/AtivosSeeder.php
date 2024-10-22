<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Ativo;

class AtivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('ativos')->insert([
                [
                    'nome' => 'Bitcoin',
                    'tipo' => 'Criptomoedas',
                    'valor_unitario' => 6.00,
                    'ultimo_preco' => 10.00,                   
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ],
                [
                    'nome' => 'Itaú',
                    'tipo' => 'Ação',
                    'valor_unitario' => 21.00,
                    'ultimo_preco' => 20.00,                    
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ],
                [
                    'nome' => 'loja 3 Magazine Luiza',
                    'tipo' => 'Fundo Imobiliário',
                    'valor_unitario' => 35.00,
                    'ultimo_preco' => 30.00,                    
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ],
            ]);
        }
    }
}
