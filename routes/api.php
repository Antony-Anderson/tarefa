<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PomodoroController;
use App\Http\Controllers\TarefaController;

Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(TarefaController::class)
    ->prefix('tarefas')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('{tarefa}/show', 'show');
        Route::post('store', 'store');
        Route::delete('{tarefa}/destroy', 'destroy');
        Route::delete('destroyAll', 'destroyAll');
        Route::put('{tarefa}/update', 'update');
        Route::post('{tarefa}/ativo', 'ativo');
    });

    Route::controller(PerfilController::class)
    ->prefix('perfil')
    ->group(function () {
        Route::get('/', 'profile');
        Route::post('mudarSenha', 'mudarSenha');
    });

    Route::controller(PomodoroController::class)
    ->prefix('pomodoro')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('store', 'store');
        Route::delete('{pomodoro}/destroy', 'destroy');
        Route::delete('deleteAll', 'deleteAll');
    });

});