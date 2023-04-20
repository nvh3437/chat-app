<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class LastActivityUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->last_activity || Carbon::now()->subMinutes(5)->greaterThan(Carbon::parse($user->last_activity))) {
            $user->last_activity = new \DateTime;
            $user->timestamps = false;
            $user->save();
        }
        return $next($request);
    }
}