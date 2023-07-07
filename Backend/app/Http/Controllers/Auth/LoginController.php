<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signup(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if($user = User::create($validatedData)) {
            event(new Registered($user));
            auth()->attempt($request->only('email' , 'password'));
            return response()->json(null, 201);
        }

        return response()->json(null, 404);
    }


    /*
	 * Generate sanctum token on successful login
	*/
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        auth()->login($user);

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken($request->email)->plainTextToken
        ], 200);
    }

    /*
	 * Revoke token; only remove token that is used to perform logout (i.e. will not revoke all tokens)
	*/
    public function logout(Request $request) {

        Auth::user()->tokens()->delete();
        try{
            auth()->logout();
        }catch(\Exception $e){

        }
        //$request->user->tokens()->delete(); // use this to revoke all tokens (logout from all devices)
        return response()->json(null, 204);
    }

}
