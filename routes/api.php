<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PaymentController;

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

//Lead API Route for Brands
Route::post('create_lead', [LeadController::class, 'create_lead_api']);

//make_payment_transaction
Route::post('create_payment', [PaymentController::class, 'make_payment_transaction']);
