<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class CheckLoginStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            // neu ton tai session 
            if ($request->session()->exists('id-student')) {
                // Thi cho no di tiep
                return $next($request);
            } else {
                // nguoc lai thi quay ve trang loginProcess
                return Redirect::route("login-student")->with('error', [
                    "message" => 'Bạn chưa đăng nhập',
                ]);
            }
        }
    }
}
