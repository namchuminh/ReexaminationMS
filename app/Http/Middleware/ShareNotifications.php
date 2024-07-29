<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class ShareNotifications
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $notifications = Notification::where('user_id', Auth::id())->orderBy('id', 'desc')->limit(10)->get();
            $totalNotifications = $notifications->count();
            $notificationsRead = Notification::where('user_id', Auth::id())->where('is_read', 0)->orderBy('id', 'desc')->limit(10)->get();
            $notificationsRead = $notificationsRead->count();
            View::share('notifications', $notifications);
            View::share('notificationsRead', $notificationsRead);
            View::share('totalNotifications', $totalNotifications);
        }

        return $next($request);
    }
}

