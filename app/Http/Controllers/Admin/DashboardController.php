<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'recentPosts' => Post::query()->latest()->take(5)->get(),
            'unreadMessages' => ContactMessage::query()->where('is_read', false)->count(),
            'totalMessages' => ContactMessage::query()->count(),
        ]);
    }
}
