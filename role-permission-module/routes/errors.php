<?php

use BugLock\rolePermissionModule\Http\Controllers\settings\Error;
use Illuminate\Support\Facades\Route;

// authentication error routes
Route::get('/unauthorized/{page?}', [Error::class, 'error'])->name('buglocks.error');
