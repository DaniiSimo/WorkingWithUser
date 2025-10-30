<?php

namespace App\Http\Controllers\Auth;

use Backpack\CRUD\app\Http\Controllers\Auth\LoginController as BaseLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;

class LoginController extends BaseLoginController
{
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string'
        ]);
    }
}
