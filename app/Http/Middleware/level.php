<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Auth;

class level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
       
        // //percobaan login ketiga
        // if(in_array($request->user()->level->toArray(), $role)){
        //     return $next($request);
        // }

        // return redirect('/');




     //percobaan login kedua   
      if (!Auth::check()){
          return redirect('login');
      }
      $user = Auth::user();

      if(in_array($user->level, $roles)){
        return $next($request);
      }

      return redirect('login')->with('error',"Anda Tidak memiliki akses ke halaman ini");
       





    //    //perocbaan login yang pertama
    //     if (Auth::user() &&  Auth::user()->level== 'admin') {
    //         return $next($request);
    //     }
        
    //     return back()->with('error', 'Maaf Kamu Bukan Admin');
     }
}
