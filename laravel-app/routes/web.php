<?php

use Illuminate\Support\Facades\Route;

use YourVendor\rolePermissionModule\Root;
use App\Http\Controllers\v1\TestController;
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

Route::get('/', function (Root $root) {
    return $root->check();
    return view('welcome');
});

// ---- Start test v1 routes ----
Route::prefix('v1')->group(function () {
    Route::get('/test-1',[TestController::class,"test1"]);

    //Add new role
    Route::get('add-role',[TestController::class,'checkRole']);
    //list all roles
    Route::get('/roles-list',[TestController::class,'roleList']);
});

// ---- End test v1 routes ----
