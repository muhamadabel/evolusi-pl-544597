<?php

use App\Http\Controllers\Api\TugasApiController;
use Illuminate\Support\Facades\Route;

// Endpoint JSON untuk dikonsumsi frontend Vue (Tugas 3)
Route::apiResource('tugas', TugasApiController::class);
