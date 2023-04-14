<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        $myid = Auth::id();
        $savedpostid = $request->post_id;
        User::find($myid)->savedposts()->attach(Post::find($savedpostid));
        
        return redirect('/posts/'.$savedpostid);
    }

    public function unsave(Request $request)
    {
        $myid = Auth::id();
        $savedpostid = $request->post_id;
        User::find($myid)->savedposts()->detach(Post::find($savedpostid));
        
        return redirect('/posts/'.$savedpostid);
    }
}
