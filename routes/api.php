<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Redirect;

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

Route::resource('devices', DeviceController::class)
        ->missing(function (Request $request) {
            return Redirect::route('devices.index');
        });
Route::get('search',[DeviceController::class, 'search']);
/*Route::resource('devices', DeviceController::class)
->except([
    'create', 'store', 'update', 'destroy'
]);

Route::resource('devices', DeviceController::class)->only([
    'index', 'show'
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/