<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function loginCheck()
    {
        $currUser = Auth::user();

        if (empty($currUser)) {
            return view('login');
        }

        return view('dashboard');
    }
}
