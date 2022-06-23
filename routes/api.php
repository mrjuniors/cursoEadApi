<?php

use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController,
    SupportController,
    ReplySupportController,
    
};
use App\Http\Controllers\Api\Auth\AuthController;


use Illuminate\Support\Facades\Route;

/**
 * Auth
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

        /**
    * ROTAS CURSOS
    */
    Route::get('/courses', [CourseController::class, 'index']); //devolve todos os cursoes
    Route::get('/courses/{id}', [CourseController::class, 'show']);//devolve um curso especifico

    /**
    * ROTA DE MODULOS
    */
    Route::get('/courses/{id}/modules', [ModuleController::class, 'index']); //devolve os modules por id de curso

    /**
    * ROTA DE LESSONS
    */
    Route::get('/modules/{id}/lessons', [LessonController::class, 'index']); //devolve uma lesson de um modulo
    Route::get('/lessons/{id}', [LessonController::class, 'show']); //devolve todas as lessons

    /**
     * ROTA PARA RETORAR O SUPORTE
     */
    Route::get('/my-supports', [SupportController::class, 'mySupports']); //devolve todos os supports de um utilizador autenticado
    Route::get('/supports', [SupportController::class, 'index']); //devolve todos os supports estado P
    Route::post('/supports', [SupportController::class, 'store']); //insere um support
    Route::post('/replies', [ReplySupportController::class, 'createReply']); //responde a um pedido de suporte

});

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});
