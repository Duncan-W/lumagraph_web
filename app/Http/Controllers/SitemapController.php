<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $excludedPrefixes = ['_ignition', 'sanctum', 'api']; // Add any others you want to exclude
        // Filter static routes
        $routes = collect(Route::getRoutes()->get())
        ->filter(function ($route) use ($excludedPrefixes) {
            // Exclude routes that contain any of the excluded prefixes
            $uri = $route->uri();
            
            // Check if the URI contains any of the excluded prefixes
            $isExcluded = collect($excludedPrefixes)->contains(function ($prefix) use ($uri) {
                return str_contains($uri, $prefix);
            });

            return in_array('GET', $route->methods()) &&
                $route->getName() &&
                strpos($uri, '{') === false && // Exclude parameterized routes
                !$isExcluded && // Exclude internal routes
                !str_contains($uri, '/create'); // Exclude 'create' routes
        })
        ->map(function ($route) {
            return [
                'loc' => url($route->uri()),
                'priority' => $this->getPriority($route->uri()),
            ];
        });


        // Add dynamic blog post URLs
        $blogPosts = Post::all()->map(function ($post) {
            return [
                'loc' => url("/posts/{$post->slug}"),
                'priority' => '0.7', // Adjust as needed
            ];
        });

        // Merge static routes and dynamic blog posts
        $urls = $routes->merge($blogPosts);

        // Pass URLs to the view
        $content = view('sitemap', ['urls' => $urls]);

        return Response::make($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    /**
     * Assign priorities dynamically.
     */
    private function getPriority($uri)
    {
        $priorityMap = [
            '/' => '1.0',
            '/products' => '0.8',
            '/blog' => '0.8',
            '/contact' => '0.7',
            '/team' => '0.5',
        ];

        return $priorityMap[$uri] ?? '0.8';
    }
}

