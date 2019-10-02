<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LastUserActivity
{
    public function handle($request, Closure $next) {
        if(Auth::check()){
            $expieresAt = Carbon::now()->addMinutes(2);
            Cache::put('user-online-'.Auth::user()->id, true,$expieresAt);
        }
        return $next($request);
    }
}
