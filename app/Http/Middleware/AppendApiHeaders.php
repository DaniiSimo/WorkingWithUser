<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppendApiHeaders
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
        $acceptHeader = (array) $request->header(key: 'Accept',default: null);
        if (!in_array('application/json', $acceptHeader, true)) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
