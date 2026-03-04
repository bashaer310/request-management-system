<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Enums\UserRole;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NotificationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id)
            ->latest()
            ->paginate(20);

        return view('notifications.index', ['notifications' => $notifications]);
    }


    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        return view('notifications.show', ['notification' => $notification]);
    }
}
