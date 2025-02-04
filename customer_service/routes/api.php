<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    return response()->json(['message' => 'API funcionando! 🚀']);
});

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index'); 
    Route::post('/', [CustomerController::class, 'store'])->name('customers.create'); 
    Route::get('{id}', [CustomerController::class, 'show'])->name('customers.show'); 
    Route::put('{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});
