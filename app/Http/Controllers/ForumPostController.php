<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('forum.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:question,discussion,announcement,help',
            'subject' => 'nullable|string|max:100',
            'course_code' => 'nullable|string|max:20',
        ]);

        $validated['user_id'] = Auth::id();

        ForumPost::create($validated);

        return redirect()->route('forum.index')
            ->with('success', 'Your post has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ForumPost $post)
    {
        // Increment view count
        $post->increment('views');

        $post->load(['user', 'replies.user', 'votes']);
        
        return view('forum.show', compact('post'));
    }

    /**
     * Store a reply to a forum post.
     */
    public function reply(Request $request, ForumPost $post)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['parent_id'] = $post->id;
        $validated['title'] = 'Re: ' . $post->title;
        $validated['category'] = $post->category;
        $validated['subject'] = $post->subject;
        $validated['course_code'] = $post->course_code;

        ForumPost::create($validated);

        return redirect()->route('forum.show', $post)
            ->with('success', 'Your reply has been posted!');
    }

    /**
     * Vote on a forum post.
     */
    public function vote(Request $request, ForumPost $post)
    {
        $validated = $request->validate([
            'type' => 'required|in:upvote,downvote',
        ]);

        $user = Auth::user();
        
        // Check if user already voted
        $existingVote = $post->votes()->where('user_id', $user->id)->first();
        
        if ($existingVote) {
            if ($existingVote->type === $validated['type']) {
                // Remove vote if same type
                $existingVote->delete();
                $post->decrement('upvotes');
            } else {
                // Change vote type
                $existingVote->update(['type' => $validated['type']]);
                if ($validated['type'] === 'upvote') {
                    $post->increment('upvotes');
                } else {
                    $post->decrement('upvotes');
                }
            }
        } else {
            // Create new vote
            $post->votes()->create([
                'user_id' => $user->id,
                'type' => $validated['type'],
            ]);
            
            if ($validated['type'] === 'upvote') {
                $post->increment('upvotes');
            }
        }

        return response()->json([
            'upvotes' => $post->fresh()->upvotes,
            'user_vote' => $post->votes()->where('user_id', $user->id)->first()?->type
        ]);
    }
}
