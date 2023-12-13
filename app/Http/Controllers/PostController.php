<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all()->sortByDesc('created_at');

        foreach ($posts as $post) {
            $post['author'] = User::find($post->author)->name;
        }

        return view('welcome', compact('posts'));
    }
}
