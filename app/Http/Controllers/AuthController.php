<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * get login page
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * login function
     */
    public function postLogin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Wrong email or password');
    }

    /**
     * logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
