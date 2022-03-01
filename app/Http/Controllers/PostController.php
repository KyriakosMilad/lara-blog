<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return Post::paginate(10);
    }

    /**
     * Get specified post from database.
     *
     * @param \App\Post $post
     * @return Post
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Store a newly created post in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "title" => "required|min:3|max:250",
            "body" => "required",
        ])->validate();

        Post::create([
            "title" => $request["title"],
            "body" => $request["body"],
        ]);

        return response()->json(["message" => "Post created successfully"], 201);
    }

    /**
     * Update specified post in database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return JsonResponse
     */
    public function update(Request $request, Post $post)
    {
        Validator::make($request->all(), [
            "title" => "required|min:3|max:250",
            "body" => "required",
        ])->validate();

        $post->update([
            "title" => $request["title"],
            "body" => $request["body"],
        ]);

        return response()->json(["message" => "Post updates successfully"]);
    }

    /**
     * Remove specified post from database.
     *
     * @param \App\Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post)
    {
        $post->forceDelete();
        return response()->json(["message" => "Post deleted successfully"]);
    }
}
