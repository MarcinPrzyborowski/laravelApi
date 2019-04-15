<?php

namespace App\Http\Middleware;

use Closure;

class RequestJson
{
    const REQUEST_JSON = '__json';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = json_decode($request->getContent(), true) ?? [];
        $request->attributes->set(self::REQUEST_JSON, $data);

        return $next($request);
    }
}
