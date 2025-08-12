<?php
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('returns the latest 10 posts', function () {
    $user = User::factory()->create();
    Post::factory()->count(12)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user, 'sanctum')->get('/api/posts');

    $response->assertOk();
    $response->assertJsonCount(10, 'posts');
    $response->assertJsonPath('posts.0.user.id', $user->id);
});

it('creates a new post', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user, 'sanctum')->post('/api/posts', [
        'title' => 'My First Post',
        'body'  => 'Hello from Laravel!',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('posts', ['title' => 'My First Post']);
});

it('creates a post and the new post appears in the latest posts list', function () {
    // Arrange: Create 10 existing posts
    $user = User::factory()->create();
    Post::factory()->count(10)->create([
        'user_id' => $user->id,
        'created_at' => now()->subSeconds(10),
    ]);

    // Act 1: Create a new post via API
    $newPostData = [
        'title' => 'Brand New Post',
        'body'  => 'This should be the latest post!',
    ];

    $createResponse = $this->actingAs($user, 'sanctum')->post('/api/posts', $newPostData);
    $createResponse->assertStatus(201);

    $newPostId = $createResponse->json('post.id');

    // Act 2: Fetch the latest 10 posts
    $getResponse = $this->actingAs($user, 'sanctum')->get('/api/posts');
    $getResponse->assertOk();

    // Assert: The first post in the list is the one we just created
    $getResponse->assertJsonPath('posts.0.id', $newPostId);
    $getResponse->assertJsonPath('posts.0.title', 'Brand New Post');

    // Optional: Ensure we're still limiting to 10
    $getResponse->assertJsonCount(10, 'posts');
});