@extends('layout')

@section('content')
    <h2 class="text-xl font-bold text-red-500 underline mb-4">{{$post->title}}</h2>
    <img src="{{$post->image_url}}" alt="">
    <div class="mt-5 mb-5">
        {!! $post->description !!}
    </div>
@stop
