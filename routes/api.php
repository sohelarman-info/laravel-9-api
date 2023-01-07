<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserApiController,
};

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
// get api route
Route::get('/users/{id?}', [UserApiController::class, 'ShowUser'])->name('ShowUser');
// post api route (single user)
Route::post('/add-user', [UserApiController::class, 'AddUser'])->name('AddUser');
// post api route (multiple user)
Route::post('/add-multiple-user', [UserApiController::class, 'AddMultipleUser'])->name('AddMultipleUser');
// put api route (update user)
Route::put('/update-user/details/{id}', [UserApiController::class, 'updateUserDetails'])->name('updateUserDetails');


