<?php

namespace App\Http\Middleware;

use Closure;

class Tracking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // tracking session
        // dd($request->utm_source);
        if (isset($_SERVER['HTTP_REFERER'])) {
            if(getDomain(env('APP_URL')) != getDomain($_SERVER['HTTP_REFERER'])) {
                if (isset($request->utm_source)) {
                    $referer = $request->utm_source;
                } else {
                    $referer = $_SERVER['HTTP_REFERER'];
                }
                session(['form_tracking' => $referer]);
            } else {
                // Có utm_source mới đổi không thì vẫn giữ tracking hiện tại
                if (isset($request->utm_source)) {
                    $referer = $request->utm_source;
                    session(['form_tracking' => $referer]);
                }
            }
             // dd(session('form_tracking'), $_SERVER['HTTP_REFERER']);
        } else {
            // $referer = 'direct';
            // $referer = $request->header('referer');
            // dd($referer);
            $referer = session('form_tracking') ?? 'direct';
            if (isset($request->utm_source)) {
                $referer = $request->utm_source;
            }
            session(['form_tracking' => $referer]);
             // dd(session('form_tracking'));
        }
        return $next($request);
    }
}
