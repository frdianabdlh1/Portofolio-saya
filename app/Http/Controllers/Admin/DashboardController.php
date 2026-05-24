<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Message;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'     => Project::count(),
            'certificates' => Certificate::count(),
            'messages'     => Message::count(),
            'unread'       => 0,
            'comments'     => Comment::count(),
            'pending'      => 0,
        ];

        $latestMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages'));
    }
}