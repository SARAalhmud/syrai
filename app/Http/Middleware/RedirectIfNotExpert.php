<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotExpert
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {
          $user = auth()->user();
        if(auth()->check() && auth()->user()->type == 'expert'){
            return $next($request); // أكمل للصفحة
        }
  if ($user->type === 'beginner') {
        return redirect()->route('beginner', ['id' => $user->id]);
    }
     if ($user->type === 'student') {
        return redirect()->route('student', ['id' => $user->id]);
    }
     if ($user->type === 'company') {
        return redirect()->route('company', ['id' => $user->id]);
    }
        // إذا مش خبير، ارجع للصفحة الرئيسية أو مكان ثاني
        return redirect('/home');
    }
}


