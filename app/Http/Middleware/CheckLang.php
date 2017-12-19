<?php

namespace App\Http\Middleware;

use Closure;

class CheckLang
{
    public function __construct()
    {
    }

    public function handle($request, Closure $next)
    {
        if (!session()->has('locale')) {
            session()->put('locale', config('app.locale'));
        } else {
            app()->setLocale(session('locale'));
        }
        return $next ($request);
    }
}
