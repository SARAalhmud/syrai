<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfStudent
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

        if (!$user || $user->type !== 'student') {
            // رجّع لصفحة غير مصرح بها أو الصفحة الرئيسية
            return redirect('/home')->with('error', 'ليس لديك صلاحية للوصول');
        }

        return $next($request); // المستخدم طالب، اسمح له بالوصول
    }
}
