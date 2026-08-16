<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $ip = $request->ip();
            $date = date('Y-m-d');

            $visitor = \App\Models\Visitor::firstOrCreate(
                ['ip_address' => $ip, 'visit_date' => $date],
                ['hits' => 0]
            );

            $visitor->increment('hits');
        } catch (\Exception $e) {
            // Ignore DB errors (e.g. during migrations)
        }

        return $next($request);
    }
}
