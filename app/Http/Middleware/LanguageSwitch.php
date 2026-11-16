<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageSwitch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale('en');
        if($request->lang_key??''){
            app()->setLocale($request->lang_key);
        }
        return $next($request);
    }
}
