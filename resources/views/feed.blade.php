@extends('layout')
@section('content')
@forelse ($posts as $post)
    <div class="py-4">
        <h2 class="text-xl font-bold text-red-500 underline"><a href="/post/{{$post->id}}" class="text-secondary">{{$post->title}}</a></h2>
        <h3 class="font-light text-gray-700">{{$post->excerpt}}</h3>
    </div>
@empty
    <p>No Posts...</p>
@endforelse
@stop
