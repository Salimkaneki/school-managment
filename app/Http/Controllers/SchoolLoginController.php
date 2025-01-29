<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolLoginController extends Controller
{
    public function create()
    {
        return view('auth.school.signin');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $rememberMe = $request->rememberMe ? true : false;

        if (Auth::guard('school')->attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            return redirect()->intended('/school/dashboard');
        }

        return back()->withErrors([
            'message' => 'Les identifiants fournis ne correspondent à aucune école.',
        ])->withInput($request->only('username'));
    }

    public function destroy(Request $request)
    {
        Auth::guard('school')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/school/sign-in');
    }
}