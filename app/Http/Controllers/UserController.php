<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('laravel-examples.users-management', compact('users'));
    }

    public function gest_users(){
        return view('gest-users');
    }

    public function gest_profile(){
        return view('gest-profile');
    }
}
