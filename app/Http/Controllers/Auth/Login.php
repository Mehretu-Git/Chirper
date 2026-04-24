<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //validate the input
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        //attempt to log in 
        if (Auth::attempt($credentials,$request->boolean('remember'))){
            //regenerate the session for security
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }
        return back()
            ->withErrors(['email'=> 'Input doen\'t match our records.'])
            ->onlyInput('email');
    }
}
