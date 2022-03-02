<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Post $post)
    {
        return Comment::where("post_id", $post->id)->paginate(10);
    }

    /**
     * Store a newly created comment in database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Post $post)
    {
        Validator::make($request->all(), [
            "body" => "required",
        ])->validate();

        Comment::create([
            "body" => $request['body'],
            "post_id" => $post->id,
            "user_id" => app()['auth_user']->id,
        ]);

        return response()->json("Comment created successfully", 201);
    }

    /**
     * Update specified comment in database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        Validator::make($request->all(), [
            "body" => "required",
        ])->validate();

        $comment->update([
            "body" => $request["body"],
        ]);

        return response()->json(["message" => "Comment updates successfully"]);
    }

    /**
     * Remove specified comment from database.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->forceDelete();
        return response()->json(["message" => "Comment deleted successfully"]);
    }
}
