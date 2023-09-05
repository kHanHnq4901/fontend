<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class CheckLoggedStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            // nếu tồn tại session
            if ($request->session()->exists('id-student')) {
                // Thi cho no di tiep
                return Redirect::route('welcomestudent');
            } else {
                // Nguoc lai thi quay ve trang login
                return $next($request);
            }
        }
    }
}
