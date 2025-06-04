<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'buglocks'], function () {

    // ***** all routes of protfolio *****
    require __DIR__ . '/package.php';

    // ***** all routes of authorization *****
    require __DIR__ .'/errors.php';

});
