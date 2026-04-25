<?php

namespace App\Http\Controllers;

use App\Models\Post; 
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); 
        return view('community.index', compact('posts'));
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}