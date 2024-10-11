<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ForumPostController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with(['user', 'replies.user'])
            ->withCount('likes', 'replies')
            ->latest()
            ->get();
        return response()->json(['posts' => $posts]);
    }

    public function create()
    {
        return view('community.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new ForumPost();
        $post->user_id = auth()->id();
        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('forum_photos', 'public');
            $post->photo = Storage::url($path);
        }

        $post->save();

        $post->load('user');
        $post->likes_count = 0;

        return response()->json([
            'success' => true,
            'post' => $post,
        ]);
    }

    public function update(Request $request, ForumPost $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        if ($request->hasFile('photo')) {
            if ($post->photo) {
                Storage::disk('public')->delete($post->photo);
            }
            $path = $request->file('photo')->store('forum_photos', 'public');
            $post->photo = Storage::url($path);
        }

        $post->save();

        return response()->json([
            'success' => true,
            'post' => $post->load('user'),
        ]);
    }

    public function destroy(ForumPost $post)
    {
        $this->authorize('delete', $post);

        if ($post->photo) {
            Storage::disk('public')->delete($post->photo);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.',
        ]);
    }

    public function reply(Request $request, ForumPost $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $reply = $post->replies()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        $reply->load('user');

        return response()->json([
            'success' => true,
            'reply' => $reply,
            'repliesCount' => $post->replies()->count(),
        ]);
    }

    public function like(ForumPost $post)
    {
        $user = auth()->user();
        $liked = $post->likes()->toggle($user->id);

        $likesCount = $post->likes()->count();

        return response()->json([
            'success' => true,
            'liked' => $liked['attached'] ? true : false,
            'likesCount' => $likesCount,
        ]);
    }

    public function editReply(ForumReply $reply)
    {
        $this->authorize('update', $reply);
        return response()->json(['reply' => $reply]);
    }

    public function updateReply(Request $request, ForumReply $reply)
    {
        $this->authorize('update', $reply);
        
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $reply->update([
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'reply' => $reply->fresh()->load('user'),
        ]);
    }

    public function deleteReply(ForumReply $reply)
    {
        $this->authorize('delete', $reply);
        
        $post = $reply->post;
        
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Associated post not found.',
            ], 404);
        }
        
        $reply->delete();

        return response()->json([
            'success' => true,
            'repliesCount' => $post->replies()->count(),
        ]);
    }
}