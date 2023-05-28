<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function login_submit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin_dashboard');
        } else {
            return redirect()->route('admin_login');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin_login');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function settings()
    {
        return view('admin.settings');
    }
}
