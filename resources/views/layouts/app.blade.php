
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Leading tech consultancy in Dublin, Ireland, specializing in data management and artificial intelligence for B2B clients. Enhance your business with our tailored AI solutions and expert data strategies. Contact us today!">
        <meta name="keywords" content="tech consultancy, data management, artificial intelligence, AI solutions, Dublin, B2B, data strategy, machine learning, predictive analytics">
        <link rel="canonical" href="https://lumagraph.ie/">
        <meta property="og:title" content="Tech Consultancy in Dublin | Data Management & AI Solutions - Lumagraph">
        <meta property="og:description" content="Discover our expert tech consultancy services in Dublin, specializing in data management and AI solutions for B2B clients.">
        <meta property="og:image" content="{{asset('images/lumagraph.svg') }}">
        <meta property="og:url" content="https://lumagraph.ie/">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Tech Consultancy in Dublin | Data Management & AI Solutions - Lumagraph">
        <meta name="twitter:description" content="Enhance your business with our tailored AI solutions and expert data strategies. Contact us today!">
        <meta name="twitter:image" content="{{asset('images/lumagraph.svg') }}">
        <meta name="robots" content="index, follow">

        <title>@yield('title', 'Lumagraph')</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js" defer></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="{{asset('images/lumagraph.svg') }}" type="image/svg+xml">
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/menu.js'])
        @php
            use Illuminate\Support\Str;
            use Illuminate\Support\Facades\App;
        @endphp

        @if (Route::currentRouteNamed('posts.show') && isset($post))
            @php
                // Convert Markdown to plain text and extract the first paragraph
                $description = Str::of(strip_tags(App::make(Str::class)->markdown($post->body)))
                    ->explode("\n")
                    ->filter(fn($line) => !empty(trim($line))) // Remove empty lines
                    ->first();

                // Handle null for dateModified
                $dateModified = $post->updated_at ? $post->updated_at->toIso8601String() : null;

                // Retrieve author name
                $authorName = $post->user->name ?? 'Unknown Author';

                // Handle image conditionally
                $imageUrl = $post->image ? asset('storage/' . $post->image) : null;
            @endphp

            {{-- Blog-specific JSON-LD for individual blog posts --}}
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "headline": "{{ $post->title }}",
                "description": "{{ $description }}",
                "author": {
                    "@type": "Person",
                    "name": "{{ $authorName }}"
                },
                "datePublished": "{{ $post->created_at->toIso8601String() }}",
                @if ($dateModified)
                "dateModified": "{{ $dateModified }}",
                @endif
                @if ($imageUrl)
                "image": {
                    "@type": "ImageObject",
                    "url": "{{ $imageUrl }}"
                },
                @endif
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ url()->current() }}"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "Lumagraph",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "{{ asset('images/lumagraph.svg') }}"
                    }
                }
            }
            </script>

        @else
            {{-- Default JSON-LD for non-blog pages --}}
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "Lumagraph",
                "url": "https://lumagraph.ie",
                "logo": "{{ asset('images/lumagraph.svg') }}",
                "description": "We are a tech consultancy firm based in Dublin, Ireland, specialising in data management and artificial intelligence solutions for B2B clients.",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "77 Camden Street Lower",
                    "addressLocality": "Dublin",
                    "addressRegion": "D",
                    "postalCode": "D02",
                    "addressCountry": "IE"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+353-0-86-406-0347",
                    "contactType": "Customer Support",
                    "areaServed": "IE",
                    "availableLanguage": ["English"]
                },
                "sameAs": [
                    "https://x.com/lumagraph_ie"
                ],
                "foundingDate": "2024",
                "founders": [
                    {
                        "@type": "Person",
                        "name": "Russell Wallace"
                    }
                ],
                "service": [
                    {
                        "@type": "Service",
                        "name": "Data Management",
                        "description": "Comprehensive data management services, including data architecture, integration, and governance."
                    },
                    {
                        "@type": "Service",
                        "name": "Artificial Intelligence Solutions",
                        "description": "Custom AI solutions tailored to your business needs, including machine learning, predictive analytics, and more."
                    }
                ],
                "areaServed": "IE",
                "hasOfferCatalog": {
                    "@type": "OfferCatalog",
                    "name": "Tech Consultancy Services",
                    "itemListElement": [
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Data Management Consulting"
                            }
                        },
                        {
                            "@type": "Service",
                            "name": "AI Strategy Consulting"
                            }
                        ]
                    }
                }
            }
            </script>
        @endif


        
       
        <!-- Styles -->
        <style>
            body {
            background-image:  url(" {{ asset('/images/dublin.jpg') }}"); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;  
            z-index: -1;  
            background-attachment: fixed;
        }

        @media (prefers-color-scheme: dark) {
            .darkmode  {
                filter: invert(1) !important;
                }

                .prose :not(img) {
                    color:white;
                }

        }

        @media (max-width: 640px) { 
            .prose{
                padding: 2px 20px !important;
            }
        }

        code::before {
            content: ' ' !important;
        }

        code::after {
            content: '' !important;
        }

        nav {
            transition: transform 1s ease-in-out;
        }

        nav.folded {
            transform: translateY(-85%);
        }

        * {font-family:Figtree, sans-serif;font-feature-settings:normal}
    
        </style>
    </head>
    <body class="antialiased">
        @include('components.header')
        @yield('content')
        @include('components.footer')
    </body>
</html>