<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginForm()
    {
        $title = 'Авторизация';
        return view('user.auth.index', compact('title'));
    }

    public function login(UserRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            session()->flash('success', 'Успешная авторизация');
            if (Auth::user()->hasRole(['admin', 'moderator'])) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        }

        return redirect()->back()->with('error', 'Не совпадает логин или пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
