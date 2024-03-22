<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->roles->first()->slug == 'admin') {
            return $next($request);
        }
        return redirect()->intended('/')->with('message', [
            'type' => 'danger',
            'autohide' => 'false',
            'title' => Lang::get('Access denied') . '!',
            'message' => Lang::get('You cannot access this section, you do not have the necessary privileges.'),
        ]);
    }
}
