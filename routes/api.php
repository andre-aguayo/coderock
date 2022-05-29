<?php

use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\InvestorController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Como nao há necessidade de autenticaçao para o teste todas as rotas srao definidas fora do middleware 'auth:sanctum'
 * 
 */

Route::prefix('investor')->group(function () {
    Route::get('/{id}', [InvestorController::class, 'show']);
    Route::post('/store', [InvestorController::class, 'store']);
    Route::get('/{id}/investments', [InvestorController::class, 'showInvestments']);
});

Route::prefix('investment')->group(function () {
    Route::get('/{id}', [InvestmentController::class, 'show']);
    Route::post('/store', [InvestmentController::class, 'store']);
    Route::get('/{id}/{projectionDate}', [InvestmentController::class, 'showInvestmentProjection']);
    Route::post('/withdraw/{id}/{withdrawDate}',[InvestmentController::class,'withdraw']);
});
