<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the API key is valid
        if ($request->header('API_KEY') !== 'helloatg') {
            return response()->json(['status' => 0, 'message' => 'Invalid API key']);
        }

        return $next($request);
    }
}
