<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogCdekRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (str_contains($request->path(), 'pvz')) {
            Log::info('[CDEK] Incoming request', [
                'method' => $request->method(),
                'path' => $request->path(),
                'params' => $request->all(),
                'ip' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}
