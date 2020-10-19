<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $auth = Auth::attempt($credentials);

        return response()->json(['auth'=>$auth]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return back();
    }
}
