<?php

namespace App\Http\Middleware;

use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            app()->setLocale(Auth::user()->language);
            Carbon::setLocale(Auth::user()->language);
        } else {
            app()->setLocale(session('locale', 'en'));
            Carbon::setLocale(session('locale', 'en'));
        }

        return $next($request);
    }
}
