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

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // let employer delete comments
        $user = auth()->user();

        if (!$user || !$user->hasRole('employer')) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
