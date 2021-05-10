<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Policies\CommentPolicy;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Comment\CreateCommentRequest;


class CommentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment', ['except' => ['index', 'show']]);
    }


    public function store(CreateCommentRequest $request)
    {
        $comment = new Comment;

        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post;
        $comment->content = $request->content;

        $comment->save();


        return response()->json([
            'message' => 'Created success',
            'status' => true,
            'comment' => $comment,
        ]);
    }


    public function destroy(Comment $comment)
    {
        //
        $comment->delete();

        return response()->json([
            'message' => 'Delete success',
            'status' => true,
        ]);
    }
}
