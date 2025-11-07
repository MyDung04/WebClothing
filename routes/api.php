<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\BlogListController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\UserController;
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
Route::get('/myproduct', [AccountController::class, 'myproduct']);
Route::get('/login', [UserController::class, 'GetMemberLogin'])->name('memberlogin');
Route::post('/login', [UserController::class, 'PostMemberLogin'])->name('memberlogin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('member.dashboard');
// Route::post('/dashboard', [DashboardController::class, 'index'])->name('member.dashboard');
Route::get('/bloglist', [BlogListController::class, 'bloglist'])->name('bloglist');
Route::get('/blogdetail/{id}', [BlogListController::class, 'blogdetail'])->name('blogdetail');
Route::post('/blogdetail/{id}', [BlogListController::class, 'blogdetail'])->name('blogdetail');
Route::post('/blog/rate/ajax', [BlogListController::class, 'rate'])->name('blograte');
