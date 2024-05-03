<?php

namespace Sudo\AdminUser\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;
class CheckLicense
{
    public function handle($request, Closure $next)
    {
        $settings = DB::table('settings')->where('key','sudo')->first();
        if (!$settings || $settings->value != md5(env('APP_URL'))) {
            exit();
        }
        return $next($request);
    }
}