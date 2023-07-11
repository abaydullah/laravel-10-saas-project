<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfCancelled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->HasSubsciption() || auth()->user()->HasCanceled()){
            return redirect()->route('account.index');
        }
        return $next($request);
    }
}
