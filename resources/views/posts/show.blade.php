@extends('layouts.app')
@section('content')
    <h1>All Blog Posts</h1>

    <div style="height: 1vh;"></div>
    <!-- Start block -->
   
            </div>                
        </div>
    </section>
    <div style="height: 20vh;"></div>
    <section class="bg-gray-50 dark:bg-gray-900">
    <h1>{{ $post->title }}</h1>
    @if ($post->image)
        <img src="{{ $post->image }}" alt="{{ $post->title }}" style="max-width: 100%;">
    @endif
    <div class="prose">
        {!! \Illuminate\Support\Str::markdown($post->body) !!}
    </div>
    <a href="{{ route('posts.index') }}">Back to Posts</a>
    </section>
@endsection