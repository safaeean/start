<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }


    public function resend()
    {
        if (auth()->user()->hasVerifiedEmail())
            return response()->json(["status" => 'Verified user cannot resend email'], 204);

        auth()->user()->sendEmailVerificationNotification();
        return response()->json(["status" => 'Verification e-mail send.', "email" => auth()->user()->email], 202);
    }

}
