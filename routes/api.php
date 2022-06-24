<?php

use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController,
    SupportController,
    ReplySupportController,
    
};
use App\Http\Controllers\Api\Auth\{
    AuthController,
    ResetPasswordController
};


use Illuminate\Support\Facades\Route;

/**
 * Auth
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

/**
 * RECUPERA A SENHA DO UTILIZADOR
 */
/**
 * Reset Password
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::middleware(['auth:sanctum'])->group(function () {
    /**
     * DEVOLVE OS DADOS DO USER LOGADO
     */
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
    Route::get('/lessons', [LessonController::class, 'viewed']); //devolve todas as views das liçoes

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
