<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimentacoesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\AplicacoesController;
use App\Http\Controllers\AtivosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('movimentacoes/saldo/{usuario_id}', [MovimentacoesController::class, 'saldo']);
Route::get('empresas/carteira-usuario/{usuario_id}', [EmpresasController::class, 'carteiraUsuario']);
Route::get('movimentacoes/movimentacoes-mes/{usuario_id}/{mes}', [MovimentacoesController::class, 'movimentacoesMes']);
Route::get('aplicacoes/distribuicao-ativos/{usuario_id}', [AplicacoesController::class, 'distribuicaoAtivos']);
Route::get('aplicacoes/rentabilidade/{usuario_id}', [AplicacoesController::class, 'listarAtivosComRentabilidade']);
Route::get('ativos', [AtivosController::class, 'listarAtivos']);
Route::post('ativos', [AtivosController::class, 'novoAtivo']);
Route::put('ativos/{id}',[AtivosController::class, 'editarAtivo']);
Route::delete('ativos/{id}', [AtivosController::class, 'deletarAtivo']);
Route::post('movimentacoes', [MovimentacoesController::class, 'novoMovimentacoes']);

