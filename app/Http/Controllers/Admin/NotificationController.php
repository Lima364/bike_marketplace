<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        return view('admin.notifications', compact('unreadNotifications'));
    }
}
