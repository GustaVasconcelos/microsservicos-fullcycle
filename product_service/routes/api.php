<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index'); 
    Route::post('/', [ProductController::class, 'store'])->name('products.create'); 
    Route::get('{id}', [ProductController::class, 'show'])->name('products.show'); 
    Route::put('{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
