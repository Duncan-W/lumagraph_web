@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    @if ($post->image)
        <img src="{{ $post->image }}" alt="{{ $post->title }}" style="max-width: 100%;">
    @endif
    <p>{!! nl2br(e($post->body)) !!}</p>
    <a href="{{ route('posts.index') }}">Back to Posts</a>
@endsection