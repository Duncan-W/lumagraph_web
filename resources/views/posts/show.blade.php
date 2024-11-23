@extends('layouts.app')
@section('content')

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

    <h1>{{ $post->title }}</h1>

    <div style="height: 1vh;"></div>
    <!-- Start block -->                

    <div style="height: 5vw;"></div>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="pt-8 px-4 mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">{{ $post->title }}</h1>
                <img src="{{ $imageUrl }}" alt="{{ $post->title }}" style="max-width: 100%;">\
        </div>
        @php
            // Render the Markdown to HTML
            $html = \Illuminate\Support\Str::markdown($post->body);

            // Use regex to find headings and add IDs
            $html = preg_replace_callback(
                '/<h([1-6])>(.*?)<\/h\1>/i',
                function ($matches) {
                    $level = $matches[1]; // Heading level (1-6)
                    $text = $matches[2];  // Text inside the heading
                    $id = strtolower(preg_replace('/\s+/', '-', trim(strip_tags($text)))); // Convert text to id
                    return "<h{$level} id=\"{$id}\">{$text}</h{$level}>";
                },
                $html
            );
        @endphp

        <article class="prose sm:px-prosePadding" style="margin:auto">
            {!! $html !!}
        </article>

        <a href="{{ route('blog') }}" class="block ml-2 py-2 pl-3 pr-4 text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800">Back to posts</a>
    </section>
    <script>
        window.addEventListener("load", function () {
            // Replace all backslashes in the body content
            document.body.innerHTML = document.body.innerHTML.replace(/\\/g, '');
            const paragraphs = document.querySelectorAll("p");
    
            // Iterate over paragraphs
            paragraphs.forEach(paragraph => {
                // Check if the paragraph's text content contains "Caption:"
                if (paragraph.textContent.includes("Caption:")) {
                    // Add the desired classes
                    paragraph.classList.add("text-xs", "text-gray-800");
                    // Remove only the substring "Caption:" while keeping the rest of the content
                    paragraph.textContent = paragraph.textContent.replace("Caption:", "").trim();
                }
            });
        });
    </script>
@endsection