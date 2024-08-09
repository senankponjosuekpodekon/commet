<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class CommentController extends Controller
{

    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with('children')
            ->whereNull('parent_id')
            ->get();
        return response()->json($comments);
    }


    public function store(Request $request, $postId)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required | string | max:150',
            'parent_id' => 'nullable | exists:comments,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ], 422);
        }

        // Check if the parent_id field is submitted
        if ($request->parent_id) {
            $parentComment = Comment::find($request->parent_id);

            // Check if the parent comment is already a child comment
            if ($parentComment && $parentComment->parent_id !== null) {
                return response()->json([
                    'error' => 'You cannot reply to a child comment.'
                ], 400);
            }
        }

        $comment = Comment::create([
            'post_id' => $postId,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        return response()->json($comment, 201);
    }


    public function show($postId)
    {
        return Comment::where('post_id', $postId);
    }


    public function update(Request $request, $postId, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required | string | max:150',
            'parent_id' => 'nullable | exists:comments,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ], 422);
        }

        $comment = Comment::where('post_id', $postId)->findOrFail($id);
        $comment->update($request->only('content', 'parent_id'));

        return response()->json($comment);
    }


    public function destroy($postId, $id)
    {
        $comment = Comment::where('post_id', $postId)->findOrFail($id);
        $comment->delete();

        return response()->noContent();
    }
}
