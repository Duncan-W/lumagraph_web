<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $excludedPrefixes = ['_ignition', 'sanctum', 'api'];

        // Filter static routes
        $routes = collect(Route::getRoutes()->get())
            ->filter(function ($route) use ($excludedPrefixes) {
                $uri = $route->uri();

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
                $uri = $route->uri();
                return [
                    'loc' => url($uri),
                    'priority' => $this->getPriority($uri),
                ];
            });

        // Add dynamic blog post URLs
        $blogPosts = Post::all()->map(function ($post) {
            return [
                'loc' => url("/posts/{$post->id}"), 
                'priority' => '0.8', // Default priority for dynamic posts (e.g. blog)
            ];
        });

        // Merge static routes and dynamic blog posts
        $urls = $routes->merge($blogPosts);

        $content = view('sitemap', ['urls' => $urls]);

        return Response::make($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    /**
     * Assign priorities dynamically based on the URI.
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

        return $priorityMap[$uri] ?? '0.5'; // Default fallback priority
    }
}

