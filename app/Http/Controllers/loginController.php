<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    

    public function index(Request $request)
    {
        
        return view('index-login');
    }

    public function authenticate(Request $request)
    {

         request()->validate([
             'username'=>'required',
              'password'=>'required',
         ]);

          $credentials = $request->only('username','password');
          if (Auth::attempt($credentials)){
              $user = Auth::user();
              if($user->level=='superadmin'){
                  return redirect('dashboard');
              }elseif($user->level=='admin'){
                  return redirect()->intended('dashboard');
              }elseif($user->level=='sales'){
                 return redirect()->intended('dashboardsales');
              }elseif($user->level=='gudang'){
                 return redirect()->intended('dashboardkar');
              }
              elseif($user->level=='accounting'){
                 return redirect()->intended('dashboardkar');
              }
            //   elseif($user->level=='admin'){
            //      return redirect()->intended('dashboardkar');
            //   }
              return redirect('/');
          }
         return redirect('login')->with('loginError', 'Login failed!');




        /*$credentials = $request->validate([
            'username'=>'required',
            'password'=>'required'

        ]);
       

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');

        }
        
        return back()->with('loginError', 'Login failed!' );*/
        
    }


    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }
    
}
