<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WebSiteController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('users', UserController::class)->only('index', 'store');
Route::post('subscrip', [UserController::class, 'subscrip']);

Route::resource('websites', WebSiteController::class)->only('index', 'store');

Route::resource('posts', PostController::class)->only('index', 'store');
Route::post('/posts/send-email-for-subscrips', [PostController::class, 'sendEmailSubscrips']);
