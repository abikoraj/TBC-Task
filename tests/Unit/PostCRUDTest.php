<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\PostCategory;
use App\Traits\FileHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\TestCase;

class PostCRUDTest extends TestCase
{
    use RefreshDatabase, FileHelper;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function it_can_create_a_post()
    {
        $category = PostCategory::factory()->create();
        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'image' => UploadedFile::fake()->image('test.jpg'),
            'post_category_id' => $category->id,
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'post_category_id' => $category->id,
        ]);
        Storage::disk('public')->assertExists('images/posts/test.jpg');
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $category = PostCategory::factory()->create();
        $post = Post::factory()->create(['post_category_id' => $category->id]);
        $newCategory = PostCategory::factory()->create();

        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
            'post_category_id' => $newCategory->id,
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
            'post_category_id' => $newCategory->id,
        ]);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        Storage::fake('public');

        $post = Post::factory()->create(['image' => 'test-image.jpg']);

        $response = $this->delete("/posts/{$post->id}");

        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
        Storage::disk('public')->assertMissing('images/posts/test-image.jpg');
    }

    /** @test */
    public function it_can_list_posts_with_filter()
    {
        $category = PostCategory::factory()->create();
        $post1 = Post::factory()->create([
            'title' => 'First Post',
            'post_category_id' => $category->id,
        ]);
        $post2 = Post::factory()->create([
            'title' => 'Second Post',
            'post_category_id' => $category->id,
        ]);

        $response = $this->get('/posts?query=First');

        $response->assertStatus(200);
        $response->assertSee($post1->title);
        $response->assertDontSee($post2->title);
    }

    /** @test */
    public function it_can_show_post_details()
    {
        $post = Post::factory()->create();

        $response = $this->get("/posts/{$post->id}");

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }
}
