<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotasController;

Route::get('/notas', [NotasController::class, 'index']);

Route::get('/notas/{id}', [NotasController::class, 'show']);

Route::post('/notas', [NotasController::class, 'store']);

Route::put('/notas/{id}', [NotasController::class, 'update']);

Route::patch('/notas/{id}', [NotasController::class, 'patch']);

Route::delete('/notas/{id}', [NotasController::class, 'destroy']);
