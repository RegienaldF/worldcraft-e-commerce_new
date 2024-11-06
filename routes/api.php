<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PhAddressController;

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
// PH ADDRESS
Route::get('/get-regions', [PhAddressController::class, 'get_regions'])->name('get-regions');
Route::get('/get-province', [PhAddressController::class, 'get_province'])->name('get-province');
Route::get('/get-city', [PhAddressController::class, 'get_city'])->name('get-city');
Route::get('/get-barangay', [PhAddressController::class, 'get_barangay'])->name('get-barangay');
