<?php

use App\Http\Controllers\v1\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[TestController::class,'login']);
Route::get('/logout',[TestController::class,'logout']);
// Testing V1
Route::prefix('v1')->group(function(){
    Route::get('/test-1',[TestController::class,'check_1']);
});

Route::group(['prefix'=>'v1','middleware'=>['buglock.auth:web,view,yes']],function(){
    Route::get('/dash-1',[TestController::class,'dash_1']);
});

Route::group(['prefix'=>'v1','middleware'=>['buglock.role:,,,']],function(){
    Route::get('/dash-2',[TestController::class,'dash_2']);
});
