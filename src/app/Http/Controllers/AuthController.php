<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{
    protected $createNewUser;

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        }

        throw new AuthenticationException('ログインに失敗しました。');
    }
}
