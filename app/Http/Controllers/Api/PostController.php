<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostCategory;
use App\Traits\FileHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use FileHelper;

    public function index()
    {
        $posts = Post::with(['user', 'postCategory'])->latest()->paginate(5);
        return PostResource::collection($posts);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_category_id' => 'required|exists:post_categories,id'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $filename = $this->fileUpload($request->file('image'), 'images/posts');
            $post->image = $filename;
        }

        $post->user_id = auth()->id();
        $post->post_category_id = $request->post_category_id;
        $post->save();

        return response()->json(['success' => true, 'message' => 'Post created successfully'], 201);
    }

    public function show($id): JsonResponse
    {
        $post = Post::with(['user', 'postCategory'])->find($id);
        if (!$post) {
            return response()->json(['error' => true, 'message' => 'Post not found'], 404);
        }
        return response()->json(['success' => true, 'data' => new PostResource($post)], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_category_id' => 'required|exists:post_categories,id'
        ]);

        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => true, 'message' => 'Post not found'], 404);
        }

        $post->post_category_id = $request->post_category_id;
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $filename = $this->fileUpload($request->file('image'), 'images/posts', $post->image);
            $post->image = $filename;
        }

        $post->save();

        return response()->json(['success' => true, 'message' => 'Post updated successfully'], 200);
    }

    public function destroy($id): JsonResponse
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => true, 'message' => 'Post not found'], 404);
        }
        if ($post->image) {
            $this->fileDelete('images/posts', $post->image);
        }
        $post->delete();
        return response()->json(['success' => true, 'message' => 'Post deleted successfully'], 200);
    }

    public function list(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');

        $posts = Post::query();

        if ($query) {
            $posts->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('body', 'LIKE', "%{$query}%");
            });
        }

        if ($categoryId) {
            $posts->where('post_category_id', $categoryId);
        }

        $posts = $posts->with(['user', 'postCategory'])->paginate(5);

        return PostResource::collection($posts);
    }

    public function detail($id): JsonResponse
    {
        $post = Post::with(['user', 'postCategory'])->find($id);
        if (!$post) {
            return response()->json(['error' => true, 'message' => 'Post not found'], 404);
        }
        return response()->json(['success' => true, 'data' => new PostResource($post)], 200);
    }
}
