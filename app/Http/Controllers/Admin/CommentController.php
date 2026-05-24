<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Comment::latest()->paginate(20);
        $pendingCount = Comment::where('is_approved', false)->count();

        return view('admin.comments.index', compact('comments', 'pendingCount'));
    }

    public function approve(Comment $comment): RedirectResponse
    {
        $comment->update(['is_approved' => true]);
        return back()->with('success', 'Komentar disetujui.');
    }

    public function reject(Comment $comment): RedirectResponse
    {
        $comment->update(['is_approved' => false]);
        return back()->with('success', 'Komentar ditolak.');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        if ($comment->image) {
            Storage::disk('public')->delete($comment->image);
        }
        $comment->delete();
        return back()->with('success', 'Komentar dihapus.');
    }
}