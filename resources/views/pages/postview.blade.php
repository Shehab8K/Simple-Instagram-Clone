<header>
    <nav class="navbar">
        <div class="nav-wrapper">
            <img src="{{ asset('img/logo.PNG') }}" class="brand-img" alt="">
            <!-- working down -->
            <!-- @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
            <!-- @else -->
            <form method="POST" action="/searcheduser">
                @csrf
                <input type="text" class="search-box" placeholder="search" name="searchedUser">
            </form>
            <div class="nav-items">
                <a href="/home"><img src="{{ asset ('img/home.PNG') }}" class="icon" alt=""></a>
                <a href="#"><img src="{{ asset ('img/messenger.PNG') }}" class="icon" alt=""></a>
                <a href="/posts/create"><img src="{{ asset ('img/add.PNG') }}" class="icon" alt=""></a>
                <a href="#"><img src="{{ asset ('img/explore.PNG') }}" class="icon" alt=""></a>
                <a href="#"><img src="{{ asset ('img/like.PNG') }}" class="icon" alt=""></a>
                <div class="icon user-profile">
                    <div class="btn-group">
                        <button type="button" class="userPPbutton dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="loggedinPP"
                                src="<?php echo asset('/storage'.$currentuser->avatar) ?>" />
                        </button>
                        <div class="dropdown-menu">
                            @auth
                            <a class="dropdown-item far fa-user-circle" href="/users/{{auth()->user()->id}}"><span
                                    class="dropdownmove">Profile</span></a>
                            @endauth
                            <a class="dropdown-item far fa-bookmark" href="#" style="margin-left: 2px;"><span
                                    class="dropdownmove">Saved</span> </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endguest
            <!-- working above -->
            <!-- <form method="GET" action="/">
        <input type="text" class="search-box" placeholder="search" name="searchedUser">
        </form>
        <div class="nav-items">
            <a href="#"><img src= "{{ asset ('img/home.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/messenger.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/add.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/explore.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/like.PNG') }}" class="icon" alt=""></a>
            <div class="icon user-profile">
            <div class="btn-group">
            <button type="button" class="userPPbutton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="loggedinPP" src="{{ asset('img/cover 9.png') }}"/>
            </button>
            <div class="dropdown-menu">
                    <a class="dropdown-item far fa-user-circle" href="#"><span class="dropdownmove">Profile</span></a>
                    <a class="dropdown-item far fa-bookmark" href="#" style="margin-left: 2px;"><span class="dropdownmove">Saved</span> </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
            </div>
            </div>
            </div>
        </div> -->
            <!-- ------------- -->
        </div>
    </nav>
</header>
@extends('layouts.app')
@section('title', 'Post View')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="{{ URL::asset('css/postview.css') }}">
<script src="https://kit.fontawesome.com/8ba67097ac.js" crossorigin="anonymous"></script>
@section('content')
<!-- <script>
    var loveButton = false;
    var saved =false;
    function love(){
        if(loveButton)
        {
            var x =document.getElementsByClassName('fa-heart')[0];
            x.classList.remove('fas');
            x.classList.add('far');
            loveButton = false;
        }
        else
        {
            var x =document.getElementsByClassName('fa-heart')[0];
            x.classList.remove('far');
            x.classList.add('fas');

            loveButton = true;
        }
    }
    function save(){
        if(saved)
        {
            var x =document.getElementsByClassName('fa-bookmark')[1];
            x.classList.remove('fas');
            x.classList.add('far');
            saved = false;
        }
        else
        {
            var x =document.getElementsByClassName('fa-bookmark')[1];
            x.classList.remove('far');
            x.classList.add('fas');
            saved = true;
        }
    }
</script> -->
<?php
    $notliked = true;
                                $notsaved = true;
                                ?>
<div class="editcontainer22">
    @foreach($posts as $post)
    <div class="leftcontent">
        <img class="postImg"
            src="<?php echo asset('/storage'.$post->image); ?>" />
    </div>
    @endforeach
    <div class="rightcontent">
        @foreach($posts as $post)
        <div class="postowner">
            <img class="postownerPP"
                src="<?php echo asset('/storage'.$post->user->avatar); ?>" />
            <a href="/users/{{ $post->user->id }}" class="postwriter">{{ $post->user->name}}</a>
        </div>
        @endforeach
        <div class="scrolled">
            <div class="postcaption">
                <p class="caption">{{ $posts[0]->caption }}</p>
                @foreach($tags as $tag)
                <form method="POST"
                    action="<?php echo "/tags/".$tag->id; ?>"
                    class="tagform">
                    @csrf
                    <input type="hidden" name="tagname" value="{{ $tag->tag }}" />
                    <button type="submit" class="tagbutton">{{ $tag->tag }}</button>
                </form>
                @endforeach
            </div>
            <hr style="clear: both;" />
            @foreach($comments as $comment)
            <div class="postcomments">
                <img class="commentownerPP"
                    src="<?php echo asset('/storage/'.$comment->user->avatar); ?>" />
                <a href="/users/{{ $comment->user->id }}" class="commentwriter">{{ $comment->user->name}}</a>
                <span class="comment">{{ $comment->comment }}</span>
                <p class="commentdate">Added in <span>{{ $comment->published_at }}</span></p>
            </div>
            @endforeach
        </div>
        <div class="interactionPart">
            <!-- like -->
            @foreach($likes as $like)
            @if($like->user_id == $userID)
            <form id="likeform" action="/dislike" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts[0]->id }}" />
                <button class="fas fa-heart fa-lg editbutton" onclick="love();"></button>
            </form>
            <?php  $notliked = false; ?>
            @endif
            @endforeach
            @if($notliked)
            <form id="likeform" action="/like" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts[0]->id }}" />
                <button class="far fa-heart fa-lg editbutton" onclick="love();"></button>
            </form>
            @endif
            <!-- Save -->
            @if(isset($postssave))
            @foreach($postssave as $postsave)
            @if($postsave->id == $userID)
            <form id="saveform" action="/unsave" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts[0]->id }}" />
                <button class="fas fa-bookmark fa-lg editbutton" onclick="save();"></button>
            </form>
            <?php  $notsaved = false; ?>
            @endif
            @endforeach
            @endif
            @if($notsaved)
            <form id="saveform" action="/save" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $posts[0]->id }}" />
                <button class="far fa-bookmark fa-lg editbutton" onclick="save();"></button>
            </form>
            @endif
            <!-- end -->
        </div>
        <div class="likes"><span>{{ $likecounts }}</span> likes</div>
        <div class="postdate">Posted in <span>{{ $posts[0]-> published_at}}</span></div>
        <div class="form">
            <form method="POST" action="{{ route('comments.store')}}">
                @csrf
                <div class="comment-wrapper">
                    <img src="{{ asset('img/smile.PNG') }}" class="icon" alt="">
                    <input type="hidden" name="post_id" value="{{ $posts[0]->id }}" />
                    <input type="text" class="comment-box" name="comment" placeholder="Add a comment">
                    <button class="comment-btn" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection