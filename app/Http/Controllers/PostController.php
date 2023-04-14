<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comments;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $currentuser = User::find($userId);
        return view('pages.newpost')->with('id', $userId)->with('currentuser', $currentuser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $path = $request->file('photo')->store('public/posts');
        $path2 = substr($path, 6);
        $posts = Post::create([
            'user_id'=> $userId,
            'caption'=> $request->caption,
            'image'=> $path2
        ]);

        $tags = $request->tag;
        preg_match_all('/#([^\s]+)/', $tags, $matches);
        $result = array_unique($matches[0]);
        foreach ($result as $tag) {
            $tags = Tag::create([
            'tag' => $tag,
            'post_id' => $posts->id
            ]);
        }

        $numberOfPosts = Post::select('user_id')->where('user_id', $userId)->get();
        $counts = $numberOfPosts->count();


        $user = User::find($userId)->update([
            'no_of_posts' => $counts
        ]);
        return redirect('/users/'.$userId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $postid = $id;
        $currentuser = User::find($userId);
        $posts = Post::with('user')->where('id', $postid)->get();
        $comment = Comments::with('user')->where('post_id', $posts[0]->id)->get();

        $tag = Tag::all()->where('post_id', $posts[0]->id);
        $likes = Like::all()->where('post_id', $postid);
        $postssave = Post::find($id)->savedposts()->get();
        $numberOfLikes = Like::select('post_id')->where('post_id', $id)->get();
        $likecounts = $numberOfLikes->count();

        return view('pages.postview')->with('posts', $posts)->with('comments', $comment)
                                     ->with('tags', $tag)->with('likes', $likes)->with('currentuser', $currentuser)
                                     ->with('userID', $userId)->with('likecounts', $likecounts)->with('postssave', $postssave);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
