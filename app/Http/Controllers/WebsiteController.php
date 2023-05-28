<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function dashboard_user()
    {
        return view('dashboard');
    }
   

    public function login()
    {
        return view('login');
    }

    public function login_submit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Active'
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard_user');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function registration()
    {
        return view('registration');
    }
    public function registration_submit(Request $request)
    {
        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'Pending';
        $user->token = $token;
        $user->save();

        $verification_link = url('registration/verify/' . $token . '/' . $request->email);
        $message = "Click the link to verify your email address:";
        $subject = "Email Verification";
        Mail::to($request->email)->send(new Websitemail($verification_link, $message, $subject));
    }
    public function registration_verify($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }

        $user->status = 'Active';
        $user->token = '';
        $user->save();

        echo "Registered Successfully";
    }
    public function forget_password()
    {
        return view('forget_password');
    }
    public function forget_password_submit(Request $request)
    {
        $token = hash('sha256', time());
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            dd('Email not found');
        }
        $user->token = $token;
        $user->save();


        $verification_link = url('reset-password/' . $token . '/' . $request->email);
        $message = "Click the link to verify your email address:";
        $subject = "Email Verification";
        Mail::to($request->email)->send(new Websitemail($verification_link, $message, $subject));

        echo "Check your email";
    }
    public function reset_password($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }
        return view('reset_password', compact('token', 'email'));
    }
    public function reset_password_submit(Request $request)
    {
        $user = User::where('token', $request->token)->where('email', $request->email)->first();
        $user->token = '';
        $user->password = Hash::make($request->new_password);
        $user->save();
        echo "Password reset successfully";
    }
}
