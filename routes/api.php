<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});

Route::middleware(['check.api.key'])->group(function () {
    // Todo Api routes
    Route::group(['prefix' => 'todo', 'as' => 'task.'], function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::post('/add', [TaskController::class, 'store'])->name('store');
        Route::post('/status', [TaskController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/delete', [TaskController::class, 'destroy'])->name('destroy');
    });
});