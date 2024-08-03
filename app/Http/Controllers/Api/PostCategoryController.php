<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCategoryController extends Controller
{
    public function index() : JsonResponse
    {
        $postCategory = DB::table('post_categories')->get();
        return response()->json(['success' => true, 'data' =>$postCategory], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        if (PostCategory::where('name', $request->name)->exists()) {
            return response()->json(['error' => true, 'message' => 'Post Category Already Exists!'], 400);
        }
        $postCategory = new PostCategory();
        $postCategory->name = $request->name;
        $postCategory->save();
        return response()->json(['success' => true, 'message' => 'Category Added Successfully!'], 201);
    }

    public function update(Request $request, $id) : JsonResponse
    {
        // return response()->json($request->all());
        $postCategory = PostCategory::find($id);
        if (!$postCategory) {
            return response()->json(['error' => true, 'message' => 'Category Not Found!'], 404);
        }
        $request->validate([
            'name' => 'required',
        ]);
        $postCategory->name = $request->name;
        $postCategory->save();
        return response()->json(['success' => true, 'message' => 'Category Updated Successfully!'], 200);
    }

    public function destroy($id) 
    {
        $postCategory = PostCategory::find($id);
        if (!$postCategory) {
            return response()->json(['error' => true, 'message' => 'Category Not Found!'], 404);
        }
        $postCategory->delete();
        return response()->json(['success' => true, 'message' => 'Category Deleted Successfully!'], 200);
    }
}
