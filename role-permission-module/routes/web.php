<?php

use Illuminate\Support\Facades\Route;

// routes/web.php or inside your service provider
Route::group([
    'middleware' => 'web',
    'prefix' => 'buglocks',
], function () {

    require __DIR__ . '/package.php';

    // ***** all errors routes *****
    require __DIR__ . '/errors.php';
});
