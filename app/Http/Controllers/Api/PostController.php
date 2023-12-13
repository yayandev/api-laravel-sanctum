<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
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

    public function showall() {

        $posts = Post::all();

        foreach($posts as $post) {
            $author = User::where('id', $post->author)->first()->name;
            $post['author'] = $author;
        }

        return response()->json([
            'success' => true,
            'message' => 'All posts',
            'data' => $posts
        ]);
    }

    public function showDetail($id) {

        $post = Post::where('id', $id)->first();

        if(!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ]);
        }

        $author = User::where('id', $post->author)->first()->name;

        $post['author'] = $author;

        return response()->json([
            'success' => true,
            'message' => 'Post detail',
            'data' => $post
        ]);
    }

    public function destroy(Request $request, $id) {
        $author = $request->user()->id;

        $post = Post::where('id', $id)->first();

        if(!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ]);
        }

        if($post->author != $author) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        Post::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);

    }

    public function update(Request $request, $id) {

        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Post::where('id', $id)->first();

        if(!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ]);
        }

        $author = $request->user()->id;

        if($post->author != $author) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }

        $request['slug'] = Str::slug($request->title);

        $post->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $post
        ]);
    }
}
