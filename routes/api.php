<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/videos', VideoController::class)
    ->missing(function () {
        return response()->json(['retorno' => 'Não encontrado.'], 404);
    });

Route::apiResource('/categorias', CategoriaController::class)
    ->missing(function () {
        return response()->json(['retorno' => 'Não encontrado.'], 404);
    });
