<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id();
        $postID =  $request->post_id;
        $comments = Comments::create([
            'post_id'=> $postID,
            'user_id'=> $userId,
            'comment'=> $request-> comment
        ]);
        return redirect('/posts/'.$postID);
    }

    public function destroy($id)
    {
        //
    }
}
