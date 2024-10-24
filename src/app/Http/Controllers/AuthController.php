<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    protected $createNewUser;

    public function store(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin');
            } elseif ($user->hasRole('owner')) {
                return redirect()->route('owner');
            } else {
                return redirect()->route('index');
            }
        }

        return back()->withErrors([
            'password' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }
}