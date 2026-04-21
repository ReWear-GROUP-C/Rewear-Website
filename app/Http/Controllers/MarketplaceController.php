<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get(); 
        return view('community.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|nullable|max:2048'
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->users_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->image_path = $path;
        }

        $post->save();
        return redirect()->route('community.index')->with('success', 'Post berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('community.index')->with('success', 'Post diperbarui!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        return redirect()->route('community.index')->with('success', 'Post dihapus!');
    }
}