<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\School;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->has('rememberMe');

        // Tentative de connexion en tant qu'administrateur
        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Tentative de connexion en tant qu'école
        if (Auth::guard('school')->attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'message' => 'Les identifiants fournis ne correspondent à aucun compte.',
        ])->withInput($request->only('email'));
    }

    public function destroy(Request $request)
    {
        if (Auth::guard('school')->check()) {
            Auth::guard('school')->logout();
        } else {
            Auth::logout();
        }
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('sign-in'); // Assurez-vous d'utiliser 'sign-in' ici aussi
    }
}