<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ForumPostController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('user')->latest()->get();
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

        return response()->json([
            'success' => true,
            'post' => $post->load('user'),
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

        return response()->json([
            'success' => true,
            'reply' => $reply->load('user'),
        ]);
    }

    public function like(ForumPost $post)
    {
        $user = auth()->user();
        $liked = $post->likes()->toggle($user->id);

        return response()->json([
            'success' => true,
            'liked' => $liked['attached'] ? true : false,
            'likesCount' => $post->likes()->count(),
        ]);
    }
}