<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class TagController extends Controller
{
    public function showtag(Request $request,$id)
    {
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $tagname = $request->tagname;
        $tag = Tag::with('post')->where('tag',$tagname)->get();
        return view('pages.tags')->with('tags',$tag)->with('currentuser',$currentuser);
    }
}
