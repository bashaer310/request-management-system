<?php

use App\Http\Controllers\Api\RequestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/requests', [RequestController::class, 'index'])->name('api.requests.index');
