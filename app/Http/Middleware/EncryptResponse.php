<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;


class EncryptResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only encrypt JSON responses
        if ($response->headers->get('Content-Type') === 'application/json') {
            $data = $response->getData(true);
            $encrypted = Crypt::encrypt($data);
            return response()->json(['encrypted' => $encrypted]);
        }

        return $response;

    }
}
