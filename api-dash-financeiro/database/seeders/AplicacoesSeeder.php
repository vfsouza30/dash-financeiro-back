<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Aplicacao;

class AplicacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('aplicacoes')->insert([
                [
                    'ativo_id' => 1,
                    'quantidade' => 10,
                    'valor_total' => 60.00,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 2,
                    'quantidade' => 20,
                    'valor_total' => 420.00,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 3,
                    'quantidade' => 50,
                    'valor_total' => 1750.00,
                    'empresa_id' => 1,
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 1,
                    'quantidade' => 15,
                    'valor_total' => 90.00,
                    'empresa_id' => 2,
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 1,
                    'quantidade' => 30,
                    'valor_total' => 180.00,
                    'empresa_id' => 3,
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'ativo_id' => 3,
                    'quantidade' => 50,
                    'valor_total' => 1750.00,
                    'empresa_id' => 3,
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
