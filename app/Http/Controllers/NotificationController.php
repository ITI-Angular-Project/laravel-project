<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $allNotifications = $user->notifications()->orderByDesc('created_at')->paginate(12);

        $user->unreadNotifications->markAsRead();

        return view('pages.dashboard.notifications.index', compact('allNotifications'));
    }

    public function markRead(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            abort(403);
        }

        $user->unreadNotifications->markAsRead();

        return response()->json(['status' => 'ok']);
    }
}
