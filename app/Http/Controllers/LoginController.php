<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class LoginController
{
    public function login(){
        if(!Session::has('admin')){
            $data['nav'] = "login";
            $data['title'] = "Login Admin";
            return view('admin.login', $data);
        }else{
            return redirect('auth/dashboard');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //        echo '<pre>'; print_r($credentials);exit;
        // Check if a user exists with the given email and college_id
        $user = User::where('email', $credentials['email'])->first();


        if ($user && Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            if($user->college_id == 0){
                Session::put('admin', $user);
            }else{
                Session::put('college', $user);
            }

            return redirect('auth/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records for this college.',
        ])->onlyInput('email');
    }

    public function dashboard(){
        if(Session::has('admin')){
            return redirect('admin');
        }elseif(Session::has('college')){
            return redirect('institution');
        }else{
            return redirect('/');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/auth/dashboard');
    }
}
