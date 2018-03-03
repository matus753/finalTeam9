<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;
use Closure;
use Illuminate\Http\Request;

class Languages
{
    public function handle($request, Closure $next)
    {
        if (\session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
            //debug('lala');
        }
        else {
            app()->setLocale(config('app.fallback_locale'));
            \session()->put('locale',config('app.fallback_locale') );
            //debug('lala2');
        }

        return $next($request);
    }
}
