<?php

use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/module/{id}/lessons', [LessonController::class, 'index']); //devolve uma lesson de um modulo
Route::get('/lessons/{id}', [LessonController::class, 'show']); //devolve todas as lessons

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});
