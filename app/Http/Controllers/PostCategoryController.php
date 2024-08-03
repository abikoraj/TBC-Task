<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCategoryController extends Controller
{
    public function index()
    {
        $postCategory = DB::table('post_categories')->get();
        return view('post-category.app', ['categories' => $postCategory]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        if (PostCategory::where('name', $request->name)->exists()) {
            return back()->with('error', 'Post Category Already Exists!');
        }
        $postCategory = new PostCategory();
        $postCategory->name = $request->name;
        $postCategory->save();
        return back()->with('message', 'Category Added Successfully!');
    }

    public function update(Request $request, PostCategory $postCategory)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $postCategory->name = $request->name;
        // dd($category);
        $postCategory->save();
        return back()->with('message', 'Category Updated Successfully!');
    }

    public function destroy(PostCategory $postCategory) {
        $postCategory->delete();
        return back()->with('message','Category Deleted Successfully!');
    }
}
