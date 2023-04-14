<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LikeController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();
        $postId = $request->post_id;
        $like = Like::create([
            'user_id'=> $userId,
            'post_id'=> $postId
        ]);

        $numberOfLikes = Like::select('post_id')->where('post_id', $postId)->get();
        $counts = $numberOfLikes->count();

        $increaselikes = Post::find($postId)->update([
            'like' => $counts,
        ]);

        return redirect('/posts/'.$postId);
    }

    public function destroy(Request $request)
    {
        $userId = Auth::id();
        $postId = $request->post_id;
        $like =  Like::where('user_id', $userId)->delete();
        

        $numberOfLikes = Like::select('post_id')->where('post_id', $postId)->get();
        $counts = $numberOfLikes->count();

        $increaselikes = Post::find($postId)->update([
            'like' => $counts,
        ]);

        return redirect('/posts/'.$postId);
    }
}
