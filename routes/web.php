<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use TheSeer\Tokenizer\Token;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->middleware('auth');

Auth::routes(['verify'=>true]);

Route::group(['middleware' => ['auth','verified']], function() {
 
    // users
Route::get('/users/{id}/editprofile',[UserController::class, 'editprofile'])->name('usersprofile.edit');

Route::put('/users/{id}', [UserController::class, 'updateprofile'])->name('usersprofile.update');

Route::get('/users/{id}/editpassword',[UserController::class, 'editpassword'])->name('userspassword.edit');

Route::put('/users/{id}/password', [UserController::class, 'updatepassword'])->name('userspassword.update');

Route::get('/users/{id}/editprofilepicture',[UserController::class, 'editprofilepicture'])->name('usersprofilepicture.edit');

Route::put('/users/{id}/profilepicture', [UserController::class, 'updateprofilepicture'])->name('usersprofilepicture.update');

Route::get('/users/{id}',[UserController::class, 'show'])->name('users.show');

Route::get('/users/saved/{id}',[UserController::class, 'showsaved'])->name('users.showsaved');

// search user

Route::post('/searcheduser', [UserController::class, 'search'])->name('users.search');
// posts

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts',[PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Tags 

Route::post('/tags/{id}', [TagController::class, 'showtag'])->name('tags.show');

// comments

Route::post('/comments',[CommentController::class, 'store'])->name('comments.store');

// likes
Route::post('/like',[LikeController::class, 'store'])->name('like.store');

Route::post('/dislike',[LikeController::class, 'destroy'])->name('like.destroy');

// saves

Route::post('/save',[SaveController::class,'save'])->name('posts.save');

Route::post('/unsave',[SaveController::class,'unsave'])->name('posts.unsave');

// Follow

Route::post('/follow', [FollowController::class, 'follow'])->name('follow');

Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::get('/followers/{id}',[FollowController::class, 'showfollowers'])->name('followers.show');

Route::get('/following/{id}',[FollowController::class, 'showfollowing'])->name('following.show');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/test', function(){
    return view('pages.follow');
});
