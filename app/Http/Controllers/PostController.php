<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Traits\FileHelper;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use FileHelper;

    public function index()
    {
        $posts = Post::paginate(5);
        return view('post.app', compact('posts'));
    }

    public function create()
    {
        $postCategories = PostCategory::all();
        return view('post.create', compact('postCategories'));
    }

    public function store(Request $request)
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

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $postCategories = PostCategory::all();
        return view('post.edit', compact('post', 'postCategories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_category_id' => 'required|exists:post_categories,id'
        ]);

        $post->post_category_id = $request->post_category_id;
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $filename = $this->fileUpload($request->file('image'), 'images/posts', $post->image);
            $post->image = $filename;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            $this->fileDelete('images/posts', $post->image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function list()
    {
        $posts = Post::paginate(5);
        return view('frontend.index', compact('posts'));
    }
}
