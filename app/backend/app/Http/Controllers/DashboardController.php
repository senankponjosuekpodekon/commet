<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\DeletedUser;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function getTotalUsers(): JsonResponse
    {
        return response()->json([
            'total_users' => User::count()
        ]);
    }

    public function getUsersCountByPeriod(string $period): JsonResponse
    {
        $startDate = null;
        $endDate = null;

        switch ($period) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::tomorrow();
                break;
            case 'week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            default:
                return response()->json(['error' => 'Invalid period specified.'], 400);
        }

        $count = User::whereBetween('created_at', [$startDate, $endDate])->count();

        return response()->json([
            'count' => $count
        ]);
    }

    public function getPopularTags(int $monthsAgo = 0): JsonResponse
    {
        $startDate = Carbon::now()->subMonths($monthsAgo + 3)->startOfMonth();
        // $endDate = Carbon::now()->subMonths($monthsAgo)->endOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $tags = Tag::select('tags.id', 'tags.name', DB::raw('COUNT(post_tag.post_id) as tag_count'))
         ->join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
         ->join('posts', 'posts.id', '=', 'post_tag.tag_id')
         ->whereBetween('posts.created_at', [$startDate, $endDate])
         ->groupBy('tags.id', 'tags.name')
         ->orderBy('tag_count','desc')
         ->limit(10)
         ->get();      

        return response()->json($tags);
    }

    public function getTopCommentedPosts(): JsonResponse
    {
        $startDate = Carbon::now()->subMonths(3)->startOfMonth();
     
        $posts = Post::select('posts.id', 'posts.title', 'posts.content', 'posts.created_at', DB::raw('COUNT(comments.id) as comment_count'))
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->where('posts.created_at', '>=', $startDate)
            ->groupBy('posts.id', 'posts.title', 'posts.content', 'posts.created_at')
            ->orderBy('comment_count', 'desc')
            ->limit(100)
            ->get();

        return response()->json($posts);
    }
    public function getDeletedUsersCountByPeriod(string $period): JsonResponse
    {
    $startDate = null;
    $endDate = null;

    switch ($period) {
        case 'today':
            $startDate = Carbon::today();
            $endDate = Carbon::tomorrow();
            break;
        case 'week':
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
            break;
        case 'month':
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            break;
        default:
            return response()->json(['error' => 'Invalid period specified.'], 400);
    }

    $count = DeletedUser::whereBetween('deleted_at', [$startDate, $endDate])
        ->count();

    return response()->json([
        'deleted_users_count' => $count
    ]);
    }   

}
