<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class NoAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (! $user->hasRole('admin'))
            return response()->view('common.no_access');
        return $next($request);
    }
}
