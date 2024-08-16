@extends('layouts.app')
@section('content')

<div style="height: 15vh;"></div>
<section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
          <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Blog</h2>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Explore the latest trends, expert advice, and actionable strategies in IT consultation to stay ahead in a rapidly evolving tech landscape.</p>
      </div> 
      @if($posts)
      <div class="grid gap-8 lg:grid-cols-2">
          @foreach($posts as $post)
          <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
              <div class="flex justify-between items-center mb-5 text-gray-500">
                  <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                      <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                      {{ $post->post_type_id ? $post->post_type_id : 'Tutorial' }} <!-- blank on empty date -->
                  </span>
                  
              </div>
              @php
                // Assuming $post->image contains the relative path to the image, e.g., 'images/posts/image1.jpg'
                $imagePath = 'images/posts/' . $post->image;
                // default image
                $imageUrl = 'https://images.unsplash.com/photo-1682407186023-12c70a4a35e0?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2832&amp;q=80';

                // Check if the image file exists in the public directory
                if (File::exists(public_path($imagePath))) {
                    $imageUrl = asset($imagePath);
                }
               
            @endphp
              <div class="grid min-h-[140px]  w-full  place-items-center rounded-lg p-6 lg:overflow-visible">
                <img
                    class="object-cover object-center w-full max-w-xs sm:max-w-md lg:max-w-full  rounded-lg shadow-xl h-96 shadow-blue-gray-900/50"
                    src="{{ $imageUrl }}"
                    alt=""
                />
                </div>
              <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
              </h2>
              <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
              <time datetime="{{ $post->created_at->toIso8601String() }}">
                    {{ $post->created_at ? $post->created_at->format('Y-m-d') : '' }} <!-- blank on empty date -->
                </time>
                  {{ Str::limit(strip_tags($post->body), 150) }}
              </p>
              <div class="flex justify-between items-center">
                  <div class="flex items-center space-x-4">
                      <img class="w-7 h-7 rounded-full" src="{{ asset('images/lumagraph.svg') }}" alt="Author avatar" />
                      <span class="font-medium dark:text-white">
                          {{ $post->user->name ?? 'Lumagraph' }} <!-- Need author table, and 1-n link; remember picture -->
                      </span>
                  </div>
                  <a href="{{ route('posts.show', $post->id) }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                      Read more
                      <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  </a>
              </div>
          </article> 
          @endforeach
      </div>
      @else
      <p>No blog posts yet. Stay tuned!</p>
      @endif
  </div>
</section>





@endsection