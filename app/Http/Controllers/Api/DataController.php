<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function postCategories() : JsonResponse
    {
        $postCategory = PostCategory::select('id', 'name')->pluck('name', 'id');
        return response()->json(['success' => true, 'data' =>$postCategory], 200);
    }
}
