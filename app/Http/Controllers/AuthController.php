<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // show login page
    public function loginPage()
    {
        return view('login');
    }

    // show register page
    public function registerPage()
    {
        return view('register');
    }

    // redirect route for admin or user
    public function checkRole()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#home');
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('user#home');
        } else {
            return abort(404);
        }
    }
}
