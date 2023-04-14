<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $base = User::where('id',$userId)->with('followings.posts.comments')->with('followings.posts.likes')->with('followings.posts.savedposts')->get();
        $allusers = User::all();
        $reversPosts = Post::orderby('published_at','DESC')->get();
        return view('pages.home')->with('id', $userId)->with('currentuser',$currentuser)->with('base',$base)->with('allusers',$allusers)->with('reverse',$reversPosts);
    }
}
