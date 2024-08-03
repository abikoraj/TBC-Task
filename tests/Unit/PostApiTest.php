<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function it_can_create_a_post_via_api()
    {
        $user = User::factory()->create();
        $category = PostCategory::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson('/api/posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'image' => UploadedFile::fake()->image('test.jpg'),
            'post_category_id' => $category->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'post_category_id' => $category->id,
        ]);
        Storage::disk('public')->assertExists('images/posts/test.jpg');
    }

    /** @test */
    public function it_can_update_a_post_via_api()
    {
        $user = User::factory()->create();
        $category = PostCategory::factory()->create();
        $post = Post::factory()->create(['post_category_id' => $category->id]);

        $newCategory = PostCategory::factory()->create();

        $response = $this->actingAs($user, 'api')->putJson("/api/posts/{$post->id}", [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
            'post_category_id' => $newCategory->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
            'post_category_id' => $newCategory->id,
        ]);
    }

    /** @test */
    public function it_can_delete_a_post_via_api()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $post = Post::factory()->create(['image' => 'test-image.jpg']);

        $response = $this->actingAs($user, 'api')->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
        Storage::disk('public')->assertMissing('images/posts/test-image.jpg');
    }

    /** @test */
    public function it_can_list_posts_with_filter_via_api()
    {
        $user = User::factory()->create();
        $category = PostCategory::factory()->create();
        $post1 = Post::factory()->create([
            'title' => 'First Post',
            'post_category_id' => $category->id,
        ]);
        $post2 = Post::factory()->create([
            'title' => 'Second Post',
            'post_category_id' => $category->id,
        ]);

        $response = $this->actingAs($user, 'api')->getJson('/api/posts?query=First');

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => 'First Post']);
        $response->assertJsonMissing(['title' => 'Second Post']);
    }

    /** @test */
    public function it_can_show_post_details_via_api()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson("/api/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => $post->title]);
    }
}
