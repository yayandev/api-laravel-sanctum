@extends('layouts.index')
@section('title', 'Home')
@section('content')
        <div class="w-full p-3">
            <h1 class="text-3xl font-bold">Posts</h1>
            @foreach ($posts as $post)
            <div class="w-full p-3 my-3 rounded bg-white border">
                <h1 class="text-3xl">{{$post->title}}</h1>
                <p class="text-lg">{{$post->body}}</p>
                <p class="text-sm">Author: {{$post->author}}</p>
                <p class="text-xs">{{$post->created_at}}</p>
            </div>
            @endforeach
        </div>
@endsection
