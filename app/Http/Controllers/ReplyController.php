<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    /**
     * Display a listing of replies.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Comment $comment)
    {
        return Reply::where("comment_id", $comment->id)->paginate(10);
    }

    /**
     * Store a newly created reply in database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Comment $comment)
    {
        Validator::make($request->all(), [
            "body" => "required",
        ])->validate();

        Reply::create([
            "body" => $request['body'],
            "comment_id" => $comment->id,
            "user_id" => app()['auth_user']->id,
        ]);

        return response()->json("Reply created successfully", 201);
    }

    /**
     * Update specified reply in database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Reply $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Reply $reply)
    {
        Validator::make($request->all(), [
            "body" => "required",
        ])->validate();

        $reply->update([
            "body" => $request["body"],
        ]);

        return response()->json(["message" => "Reply updates successfully"]);
    }

    /**
     * Remove specified reply from database.
     *
     * @param \App\Reply $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Reply $reply)
    {
        $reply->forceDelete();
        return response()->json(["message" => "Reply deleted successfully"]);
    }
}
