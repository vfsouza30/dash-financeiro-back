<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Empresa;

class EmpressasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('empresas')->insert([
                [
                    'nome' => 'Empresa 1',
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nome' => 'Empresa 2',
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nome' => 'Empresa 3',
                    'usuario_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
