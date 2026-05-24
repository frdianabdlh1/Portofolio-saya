<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::latest()->paginate(20);
        $unreadCount = Message::unread()->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show(Message $message): View
    {
        if (!$message->is_read) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}