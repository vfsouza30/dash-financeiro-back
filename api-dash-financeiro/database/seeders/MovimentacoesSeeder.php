<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Movimentacao;

class MovimentacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('movimentacoes')->insert([
                [
                    'ativo_id' => 1,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'situacao' => 'E',
                    'quantidade' => 10,
                    'valor_negociacao' => 100.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 1,
                    'empresa_id' => 2,
                    'usuario_id' => 1,
                    'situacao' => 'E',
                    'quantidade' => 20,
                    'valor_negociacao' => 200.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 1,
                    'empresa_id' => 3,
                    'usuario_id' => 1,
                    'situacao' => 'E',
                    'quantidade' => 30,
                    'valor_negociacao' => 300.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 2,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'situacao' => 'E',
                    'quantidade' => 40,
                    'valor_negociacao' => 800.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 3,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'situacao' => 'E',
                    'quantidade' => 50,
                    'valor_negociacao' => 1500.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 3,
                    'empresa_id' => 3,
                    'usuario_id' => 1,
                    'situacao' => 'E',
                    'quantidade' => 60,
                    'valor_negociacao' => 1800.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 2,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'situacao' => 'S',
                    'quantidade' => 20,
                    'valor_negociacao' => 420.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 1,
                    'empresa_id' => 2,
                    'usuario_id' => 1,
                    'situacao' => 'S',
                    'quantidade' => 5,
                    'valor_negociacao' => 30.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 3,
                    'empresa_id' => 3,
                    'usuario_id' => 1,
                    'situacao' => 'S',
                    'quantidade' => 10,
                    'valor_negociacao' => 350.00,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
