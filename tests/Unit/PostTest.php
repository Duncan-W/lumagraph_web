<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function a_post_has_a_title()
    {
        // Arrange: Create a post instance
        $post = Post::factory()->create([
            'title' => 'Test Post Title',
        ]);

        // Act: Retrieve the title
        $retrievedPost = Post::find($post->id);

        // Assert: Check if the title is as expected
        $this->assertEquals('Test Post Title', $retrievedPost->title);
    }

    /** @test */
    public function a_post_has_body()
    {
        // Arrange: Create a post instance
        $post = Post::factory()->create([
            'body' => 'This is the body of the post.',
        ]);

        // Act: Retrieve the body
        $retrievedPost = Post::find($post->id);

        // Assert: Check if the body is as expected
        $this->assertEquals('This is the body of the post.', $retrievedPost->body);
    }

    /** @test */
    public function a_post_can_be_created_and_fetched()
    {
        // Arrange: Create a post instance
        $post = Post::factory()->create([
            'title' => 'Another Test Title',
            'body' => 'Another test body content.',
        ]);

        // Act: Retrieve the post
        $retrievedPost = Post::find($post->id);

        // Assert: Check if the attributes match
        $this->assertNotNull($retrievedPost);
        $this->assertEquals('Another Test Title', $retrievedPost->title);
        $this->assertEquals('Another test body content.', $retrievedPost->body);
    }

    /** @test */
    public function a_post_has_a_creation_date()
    {
        // Arrange: Create a post instance
        $post = Post::factory()->create();

        // Act: Retrieve the creation date
        $retrievedPost = Post::find($post->id);

        // Assert: Check if the created_at is not null
        $this->assertNotNull($retrievedPost->created_at);
    }


    public function a_post_can_have_an_image()
    {
        // Arrange: Create a post instance with an image
        $post = Post::factory()->create([
            'image' => 'https://example.com/test-image.jpg',
        ]);

        // Act: Retrieve the post
        $retrievedPost = Post::find($post->id);

        // Assert: Check if the image attribute is correctly set
        $this->assertEquals('https://example.com/test-image.jpg', $retrievedPost->image);
    }

    /** @test */
    public function a_post_can_be_created_without_an_image()
    {
        // Arrange: Create a post instance without an image
        $post = Post::factory()->create([
            'image' => null,
        ]);

        // Act: Retrieve the post
        $retrievedPost = Post::find($post->id);

        // Assert: Check if the image attribute is null
        $this->assertNull($retrievedPost->image);
    }

    /** @test */
    public function a_post_has_a_title_and_body_and_may_have_an_image()
    {
        // Arrange: Create a post with or without an image
        $post = Post::factory()->create([
            'title' => 'Test Post Title',
            'body' => 'This is the body of the post.',
            'image' => 'https://example.com/test-image.jpg',  // or null
        ]);

        // Act: Retrieve the post
        $retrievedPost = Post::find($post->id);

        // Assert: Check the attributes
        $this->assertEquals('Test Post Title', $retrievedPost->title);
        $this->assertEquals('This is the body of the post.', $retrievedPost->body);
        $this->assertEquals('https://example.com/test-image.jpg', $retrievedPost->image);
    }
}
