<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * عرض فورم إضافة كومنت
     */
    public function create(Job $job)
    {
        return view('pages.main.add-comment', compact('job'));
    }

    /**
     * حفظ الكومنت الجديد
     */
    public function store(Request $request, Job $job)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'commentable_id' => $job->id,
            'commentable_type' => Job::class,
            'body' => $request->body,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully!',
                'comment' => [
                    'user_name' => Auth::user()->name,
                    'body' => $comment->body,
                    'time_diff' => $comment->created_at->diffForHumans(),
                ],
            ]);
        }

        return redirect()
            ->route('job.details', $job->id)
            ->with('success', 'Comment added successfully!');
    }
}
