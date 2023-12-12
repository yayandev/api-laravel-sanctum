<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $request['slug'] = Str::slug($request->title);

        $request['author'] = $request->user()->id;

        $post = Post::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ]);
    }

    public function index() {

        $posts = Post::all();

        return response()->json([
            'success' => true,
            'message' => 'All posts',
            'data' => $posts
        ]);
    }
}
