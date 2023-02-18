<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\AcessosController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\NiveisController;
use App\Http\Controllers\NiveisPostosController;
use App\Http\Controllers\OrgaosController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\PerfisController;
use App\Http\Controllers\PostosController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\SetoresController;
use App\Http\Controllers\SexosController;
use App\Http\Controllers\UsersController;

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

Route::group(['middleware' =>  ['guest:api', 'middleware' => 'throttle:5,1']], function() {
    Route::post('/login', [AuthController::class, 'login']);     
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/logout', [AuthController::class, 'logout']); 
    Route::get('/check', [AuthController::class, 'check']); 

    Route::apiResource('acessos', AcessosController::class);
    Route::apiResource('cidades', CidadesController::class);
    Route::apiResource('estados', EstadosController::class);
    Route::apiResource('logs', LogsController::class);
    Route::apiResource('niveis', NiveisController::class);
    Route::apiResource('niveis-postos', NiveisPostosController::class);
    Route::apiResource('orgaos', OrgaosController::class);
    Route::apiResource('pessoas', PessoasController::class);
    Route::apiResource('paises', PaisesController::class);
    Route::apiResource('perfis', PerfisController::class);
    Route::apiResource('postos', PostosController::class);
    Route::apiResource('setores', SetoresController::class);
    Route::apiResource('sexos', SexosController::class);
    Route::apiResource('users', UsersController::class);

    Route::get('estados/{id}/cidades', [EstadosController::class, 'where']);
    Route::get('orgaos/{id}/niveis', [OrgaosController::class, 'whereNiveis']);
    Route::get('orgaos/{id}/postos', [OrgaosController::class, 'wherePostos']);
    Route::get('orgaos/{id}/setores', [OrgaosController::class, 'whereSetores']);
    Route::get('paises/{id}/estados', [PaisesController::class, 'where']);
    Route::get('users/{id}/resetpass', [UsersController::class, 'resetPass']);
    Route::post('users-changpass',  [UsersController::class, 'changPass']);

    Route::get('inicio-acessos-dia', [InicioController::class, 'acessosDia']);
    Route::get('inicio-acessos-mes', [InicioController::class, 'acessosMes']);
    Route::get('inicio-acessos-por-dia', [InicioController::class, 'acessosPorDia']);
    Route::get('inicio-acessos-por-setor', [InicioController::class, 'acessosPorSetor']);

    Route::post('upload-foto', [PessoasController::class, 'uploadFoto']);

    Route::post('rel-acessos', [RelatoriosController::class, 'relAcessos']);

    //Route::get('estados2', [EstadosController::class, 'index2']);
});