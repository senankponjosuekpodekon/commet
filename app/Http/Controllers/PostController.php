<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    function getAll(){
        return PostResource::collection(Post::all());
    }

    function getTrending(){
        $ids_n_counts = Comment::select('post_id',  DB::raw('COUNT(post_id) as comments_count'))
        ->groupBy('post_id')
        ->orderBy('comments_count', 'desc')
        ->limit(10)
        ->get();

        $posts = array_map(function ($raw) {
            $post = new PostResource(Post::find($raw['post_id']));
            return $post;
        }, [...$ids_n_counts]);


        return response()->json(['data' => $posts]);

    }

    function index($userId)
    {
        $posts = Post::get();

        if ($posts) {
            return PostResource::collection(Post::where('user_id', $userId)->get());
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }


    function store(Request $request, $userId)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:4|max:100',
            'link' => 'required|string',
            'content' => 'required|string|min:4|max:500',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ], 422);
        }


        $post = Post::create([
            'user_id' => $userId,
            'title' => $request->title,
            'link' => $request->link,
            'content' => $request->content,
        ]);


        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $newTag = Tag::firstOrCreate(
                    ['name' => $tag],
                    ['name' => $tag]
                );
                
                $post->tags()->attach($newTag);
            }
        }


        return response()->json([
            'message' => 'Post successfully added',
            'data' => new PostResource($post)
        ], 201);

        
    }

    function show($userId, $id)
    {
        return new PostResource(Post::where('user_id', $userId)->findOrFail($id));
    }

    function update(Request $request, $userId, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|min:4|max:100',
            'link' => 'required|string',
            'content' => 'required|string|min:4|max:500',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
            ], 422);
        }

        $post = Post::where('user_id', $userId)->findOrFail($id);
        $post->update([
            'title' => $request->title,
            'link' => $request->link,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => new PostResource($post)
        ], 200);
    }


    function destroy($userId, $id)
    {
        $post = Post::where('user_id', $userId)->findOrFail($id);
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully'
        ], 422);
    }
}
