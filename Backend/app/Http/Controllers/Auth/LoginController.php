<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->routeIs('register')){
            User::create($request->only('email' , 'password' , 'name'));
        }
        if(!auth()->attempt($request->only('email' , 'password'))){
            throw new AuthenticationException();
        }
    }

    /*
	 * Revoke token; only remove token that is used to perform logout (i.e. will not revoke all tokens)
	*/
    public function logout(Request $request) {

        Auth::user()->tokens()->delete();
        //$request->user->tokens()->delete(); // use this to revoke all tokens (logout from all devices)
        return response()->json(null, 204);
    }

}
