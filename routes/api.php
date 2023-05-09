<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\api\UFController;
use App\Http\Controllers\api\MunicipioController;
use App\Http\Controllers\api\BairroController;
use App\Http\Controllers\api\PessoaController;


// use App\Http\Controllers\Admin\ArtigosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// UF
Route::get('/uf', [UFController::class, 'index']);
Route::get('api/uf{data?}', [UFController::class, 'show']);
Route::put('/uf/{id}', [UFController::class, 'update']);
Route::post('/uf', [UFController::class, 'store']);
// Município
Route::get('/municipio', [MunicipioController::class, 'index']);
Route::get('/{data?}', [MunicipioController::class, 'show']);
Route::put('/municipio/{id}', [MunicipioController::class, 'update']);
Route::post('/municipio', [MunicipioController::class, 'store']);
// Bairro
// Route::get('api/bairro', [BairroController::class, 'index']);
// Route::get('api/{data?}', [BairroController::class, 'show']);
Route::get('/bairro', [BairroController::class, 'index']);
Route::get('/{data?}', [BairroController::class, 'show']);
Route::put('/bairro/{id}', [BairroController::class, 'update']);
Route::post('/bairro', [BairroController::class, 'store']); 
// Pessoa
Route::get('api/pessoa', [PessoaController::class, 'index']);
Route::post('/pessoa', [PessoaController::class, 'store']);
