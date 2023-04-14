<?php

namespace App\Http\Controllers;

use App\Models\Following;
use App\Models\Following_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
         $myid = Auth::id();
         $userID = $request->followed_id;
         User::find($myid)->followings()->attach(User::find($userID)); 
         return redirect('/users/'.$userID);
    }

    public function unfollow($id)
    {
        $myid = Auth::id();
        $userID = $id;
        User::find($myid)->followings()->detach(User::find($userID)); 
        return redirect('/users/'.$userID);
    }

    public function showfollowers($id)
    {
        $myid = Auth::id();
        $showfollower = true;
        $user = User::find($id);
        $currentuser = User::find($myid);
        $followers = User::find($id)->followers()->get();
        $followings = User::find($id)->followings()->get();
        $myfollowers = User::find($myid)->followers()->get();
        $myfollowings = User::find($myid)->followings()->get();
        return view('pages.follow')->with('showfollower',$showfollower)->with('followers',$followers)->with('followings',$followings)
        ->with('myid', $myid)->with('users',$user)->with('id',$id)->with('myfollowers',$myfollowers)->with('myfollowings',$myfollowings)
        ->with('currentuser',$currentuser);
    }

    public function showfollowing($id)
    {
        $myid = Auth::id();
        $showfollowing = true;
        $user = User::find($id);
        $currentuser = User::find($myid);
        $followers = User::find($id)->followers()->get();
        $followings = User::find($id)->followings()->get();
        $myfollowers = User::find($myid)->followers()->get();
        $myfollowings = User::find($myid)->followings()->get();
        return view('pages.follow')->with('showfollowing',$showfollowing)->with('followers',$followers)->with('followings',$followings)
        ->with('myid', $myid)->with('users',$user)->with('id',$id)->with('myfollowers',$myfollowers)->with('myfollowings',$myfollowings)
        ->with('currentuser',$currentuser);
    }
}
