<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!auth()->attempt($request->only('email' , 'password'))){
            throw new AuthenticationException();
        }
    }
}
