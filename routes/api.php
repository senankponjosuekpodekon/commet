<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// dev_api_feat_auth start
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::delete('/delete', [AuthController::class, 'delete'])->middleware('auth:sanctum');

// Lien vers la documentation api avec sa route dans le fichier scramble.php http://127.0.0.1:8000/docs/api#/

// Route protégée pour supprimer un utilisateur
//Route::middleware('auth:sanctum')->delete('/user', [AuthController::class, 'deleteUser']);


// dev_api_feat_auth end



// dev_api_feat_posts_crud start
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/posts/all', [PostController::class, 'getAll']);
    Route::get('/posts/trending', [PostController::class, 'getTrending']);

    Route::apiResource('users.posts', PostController::class);
});
// dev_api_feat_posts_crud end



// dev_api_feat_comments_crud start
Route::apiResource('posts.comments',CommentController::class)->middleware('auth:sanctum');
// dev_api_feat_comments_crud end
