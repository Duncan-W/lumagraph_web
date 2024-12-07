@extends('layouts.app')
@section('content')

@php            // this code is repeated in index.blade and should be amalgamated at some point
                // Assuming $post->image contains the relative path to the image, e.g., 'images/posts/image1.jpg'
                $imagePath = 'storage/images/blog/' . $post->image; 
                // default image
                $imageUrl = 'https://images.unsplash.com/photo-1682407186023-12c70a4a35e0?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2832&amp;q=80';

                // Check if the image file exists in the public directory
                if ($post->image && File::exists(public_path($imagePath))) {
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

            // Modify src attributes of images with relative paths to use the asset helper
            $html = preg_replace_callback(
                '/<img[^>]+src=["\']([^"\':]+)["\'][^>]*>/i',
                function ($matches) {
                    $src = $matches[1]; // Extract the src value
                    // Check if the src is relative (doesn't contain a protocol or domain)
                    if (!preg_match('/^(https?:|\/\/)/', $src)) {
                        $src = asset('images/blog/' . ltrim($src, '/')); // Use asset helper for images
                    }
                    // Reconstruct the img tag with the modified src
                    return str_replace($matches[1], $src, $matches[0]);
                },
                $html
            );

            // Modify src attributes of videos with relative paths to use the asset helper
            $html = preg_replace_callback(
                '/<video[^>]+src=["\']([^"\':]+)["\'][^>]*>/i',
                function ($matches) {
                    $src = $matches[1]; // Extract the src value
                    // Check if the src is relative (doesn't contain a protocol or domain)
                    if (!preg_match('/^(https?:|\/\/)/', $src)) {
                        $src = asset('videos/blog/' . ltrim($src, '/')); // Use asset helper for videos
                    }
                    // Reconstruct the video tag with the modified src
                    return str_replace($matches[1], $src, $matches[0]);
                },
                $html
            );
        @endphp



        <article class="prose sm:px-prosePadding" style="margin:auto">
            {!! $html !!}
        </article>

        <a href="{{ route('blog') }}" class="block ml-2 py-2 pl-3 pr-4 text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800">Back to posts</a>
    </section>
    <script defer>
    document.addEventListener("DOMContentLoaded", (event) => {
        // Replace all backslashes in the body content
        document.body.innerHTML = document.body.innerHTML.replace(/\\/g, '');
        const paragraphs = Array.from(document.querySelectorAll("p"));

        let isInTable = false; // Track whether we are between TableBegin:: and TableEnd::
        let tableParagraphs = []; // Store paragraphs within the TableBegin:: TableEnd:: block
        let iconOffset = 2; // Vertical offset in em units for icon images

        paragraphs.forEach((paragraph) => {
            if (paragraph.textContent.includes("TableBegin::")) {
                isInTable = true;
                paragraph.textContent = ""; // Remove the "TableBegin::" text from display
                return;
            }

            if (paragraph.textContent.includes("TableEnd::")) {
                isInTable = false;
                paragraph.textContent = ""; // Remove the "TableEnd::" text from display
                return;
            }

            if (isInTable) {
                // Check for images with alt text containing "icon"
                const iconImage = paragraph.querySelector("img[alt*='icon']");
                if (iconImage) {
                    // Remove the paragraph containing the image from normal flow
                    iconImage.style.width = "20px";
                    iconImage.style.position = "relative";
                    iconImage.style.left = "-50px"; // Position to the left of table paragraphs
                    iconImage.style.top = `${iconOffset * 30}px`; // Offset vertically, 5px higher
                    //iconImage.alt = ""; // Remove alt text
                } else {
                    // Add class "pl-10" to paragraphs in the table block
                    paragraph.classList.add("pl-10");

                    // If the paragraph contains "Speaker::", add "font-bold" class
                    if (paragraph.textContent.includes("Speaker::")) {
                        paragraph.classList.add("font-bold");
                        paragraph.textContent = paragraph.textContent.replace("Speaker::", "").trim();
                    }

                    tableParagraphs.push(paragraph); // Track the paragraph for positioning
                }
            }

            // Handle "Caption:" outside of TableBegin:: TableEnd::
            if (paragraph.textContent.includes("Caption:")) {
                paragraph.classList.add("text-xs", "text-gray-800");
                paragraph.textContent = paragraph.textContent.replace("Caption:", "").trim();
            }
        });

        // Minimize reflows and jumps by batching style changes
        document.body.style.visibility = "visible"; // Ensure everything renders at once
    });
</script>



@endsection