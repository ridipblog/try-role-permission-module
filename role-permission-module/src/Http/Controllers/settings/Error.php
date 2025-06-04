<?php

namespace  BugLock\rolePermissionModule\Http\Controllers\settings;

use Illuminate\Support\Facades\Request;

class Error
{
    public function error(Request $request, $page = 'auth')
    {
        
        return view('buglocksviews::settings.errors.' . $page);
    }
}
