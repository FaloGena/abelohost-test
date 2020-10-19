<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }

    public function create(RegisterUserRequest $request)
    {
        $attributes = $request->except(['_token', 'password_confirmation']);
        $user = User::create($attributes);
        Auth::login($user);
        return response()->redirectTo('/');
    }
}
