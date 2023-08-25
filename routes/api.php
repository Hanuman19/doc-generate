<?php

use App\Http\Controllers\Api\v1\DocsController;
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
////Public routs так как у нас нет авторизации АПИ будет публичный
Route::post('docs', [DocsController::class, 'download']);
Route::post('upload_logo', [DocsController::class, 'uploadLogo']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
