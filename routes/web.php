<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationEleveController;

Route::middleware(['auth'])->group(function () {
    Route::resource('eleves', EleveController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('evaluationEleves', EvaluationEleveController::class);

    Route::get('/notes/{evaluation_id}', [EvaluationEleveController::class, 'notesEval'])->name('notes.evaluation');
    Route::get('/notes/eleve/{eleve_id}', [EvaluationEleveController::class, 'notesEleve'])->name('notes.eleve');
    Route::get('/notes/failed/{evaluation_id}', [EvaluationEleveController::class, 'notesFailed'])->name('notes.evaluation.failed');

    Route::post('/eleves/{id}/upload-image', [EleveController::class, 'uploadImage'])->name('upload.image');
});

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';