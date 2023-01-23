<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function auth(Request $request){
        $credenciais = $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]
    );

        if(Auth::attempt($credenciais,request()->remember)){
            
            if(auth()->user()->habilitado == 1){
                $request->session()->regenerate();
                Log::info('Login',['Usuario'=>Auth::user()->nome,'IP'=>$request->ip()]);
                return redirect()->intended('/home');
            }
            else if(auth()->user()->habilitado == 0){
                Auth::logout();
                Log::alert('Login::Desabilitado',['Usuario'=>$request->email,'IP'=>$request->ip()]);
                return redirect()->route('login')->with('erro','Usuario desabilitado.');
            }
        }
        else{
            Log::alert('Login::Erro Usuario ou Senha',['Usuario'=>$request->email,'IP'=>$request->ip()]);
            return redirect()->back()->with('erro','Usuario ou Senha Invalida.');
        }
    }

    public function logout(Request $request)
    {
        Log::info('Logout',['Usuario'=>Auth::user()->nome,'IP'=>$request->ip()]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
