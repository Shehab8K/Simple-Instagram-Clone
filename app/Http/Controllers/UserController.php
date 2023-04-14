<?php

namespace App\Http\Controllers;

use App\Models\Following;
use App\Models\Following_user;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        $usersposts = Post::with('user')->where('user_id',$id)->get();
        $currentuser = User::find($userId);
        $followers = User::find($id)->followers()->get();
        $followings = User::find($id)->followings()->get();
        $followersCount = $followers->count();
        $followingsCount = $followings->count();
        if($userId == $id)
        {
            return view('pages.Myprofile')->with('id', $userId)->with('users',$user)
            ->with('currentuser',$currentuser)->with('followers',$followers)->with('followings',$followings)
            ->with('followerscount',$followersCount)->with('followingscount',$followingsCount)->with('userposts',$usersposts);
        }
        else
        {
            return view('pages.profile')->with('id', $userId)->with('users',$user)
            ->with('currentuser',$currentuser)->with('followers',$followers)->with('followings',$followings)
            ->with('followerscount',$followersCount)->with('followingscount',$followingsCount)->with('userposts',$usersposts);
        }
    }

    public function showsaved($id)
    {
        $savedposts = true;
        $userId = Auth::id();
        $user = User::find($id);
        $usersposts = Post::with('user')->where('user_id',$id)->get();
        $currentuser = User::find($userId);
        $followers = User::find($id)->followers()->get();
        $followings = User::find($id)->followings()->get();
        $followersCount = $followers->count();
        $followingsCount = $followings->count();
        $usersavedposts = User::find($userId)->savedposts()->get();
        if($id == $userId)
        {
        return view('pages.Myprofile')->with('id', $userId)->with('users',$user)
        ->with('currentuser',$currentuser)->with('followers',$followers)->with('followings',$followings)
        ->with('followerscount',$followersCount)->with('followingscount',$followingsCount)->with('userposts',$usersposts)
        ->with('savedposts',$savedposts)->with('usersavedposts',$usersavedposts);
        }
        else
        {
            return redirect('users/saved/'.$userId);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editprofile($id)
    {
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $user = User::find($id);
        return view('pages.editprofile')->with('id', $userId)->with('users',$user)->with('currentuser',$currentuser);
    }

    public function editpassword($id)
    {
        $userId = Auth::id();
        $currentuser = User::find($userId);
        return view('pages.editprofilePassword')->with('id', $userId)->with('currentuser',$currentuser);
    }

    public function editprofilePicture($id)
    {
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $user = User::find($id);
        return view('pages.editprofilepicture')->with('id', $userId)->with('users',$user)->with('currentuser',$currentuser);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateprofile(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->email == $request->email)
        {
            $user = User::find($id)->update([
                'name' => $request -> name,
                'username' =>  $request -> username,
                'website' => $request -> website,
                'bio' => $request -> bio,
                'phone' => $request -> phone,
                'gender' => $request -> gender
            ]);
        }
        else
        {
            $user = User::find($id)->update([
                'name' => $request -> name,
                'email'=> $request -> email,
                'email_verified_at' => null,
                'username' =>  $request -> username,
                'website' => $request -> website,
                'bio' => $request -> bio,
                'phone' => $request -> phone,
                'gender' => $request -> gender
            ]);
        }
        return redirect('/home');
    }

    public function updatepassword(Request $request, $id)
    {
        $user = User::find($id);
        if(Hash::check($request->oldpassword, $user->password))
        {
            if($request->password == $request->confirmpassword)
            {
                $user = User::find($id)->update([
                    'password'=> Hash::make($request->password)
                ]);
                return redirect('/home');
            }
            else
            {
                 return view('pages.editprofilepassword')->with('message', 'Wrong Confirm Password');
            }
        }
        else
        {
            return view('pages.editprofilepassword')->with('message', 'Wrong Old Password');
        }
       
    }

    public function updateprofilePicture(Request $request, $id)
    {
        $userId = Auth::id();
        if($request->photo == null)
        {
            return redirect('/users/'.$userId);
        }
        else
        {
            $path = $request->file('photo')->store('public/avatars');
            $path2 = substr($path, 6);
            $user = User::find($id)->update([
                'avatar'=> $path2
            ]);
            return redirect('/users/'.$userId);
        }
    }

    public function search(Request $request)
    {
        $searchedName = $request->searchedUser;
        $user = User::select('id')->whereNameOrUsername($searchedName, $searchedName)->get();
        $id = $user[0]->id;
        return redirect('/users/'.$id);
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
