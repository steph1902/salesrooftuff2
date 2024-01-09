<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesAuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('sales.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('sales')->attempt($credentials)) {
            // Authentication successful
            return redirect()->route('sales.dashboard');
        } else {
            // Authentication failed
            return redirect()->route('sales.login')->with('error', 'Invalid credentials.');
        }
    }

    public function logout()
    {
        Auth::guard('sales')->logout();

        return redirect()->route('sales.login');
    }
}
