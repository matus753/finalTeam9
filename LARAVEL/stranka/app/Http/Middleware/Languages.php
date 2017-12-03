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
        }
        else {
            app()->setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
