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

        </div>
    </nav>
</header>
@extends('layouts.app')
@section('title', 'Home')
@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
<script src="https://kit.fontawesome.com/8ba67097ac.js" crossorigin="anonymous"></script>

<body>
    <?php $noPosts=true; ?>
    <section class="main">
        <div class="wrapper">
            <div class="left-col">
                @foreach($reverse as $Rpost)
                @foreach($base as $main)
                @foreach($main->followings as $users)
                @foreach($users->posts as $post)
                @if($Rpost->id == $post->id)
                <?php $noPosts=false; ?>
                <div class="post">
                    <div class="info">
                        <div class="user">
                            <div class="profile-pic"><img
                                    src="<?php echo asset('/storage'.$users->avatar); ?>"
                                    alt=""></div>
                            <p class="username">{{$users->name}}</p>
                        </div>
                        <img src="{{ asset('img/option.PNG')}}" class="options" alt="">
                    </div>
                    <a
                        href="<?php echo "/posts/".$post->id; ?>"><img
                            src="<?php echo asset('/storage'.$post->image); ?>"
                            class="post-image" alt=""></a>
                    <div class="post-content">
                        <div class="reaction-wrapper">
                            <?php $notliked = true; ?>
                            @foreach($post->likes as $like)
                            @if($like->user_id == $id)
                            <form id="likeform" action="/dislike" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                <button class="fas fa-heart fa-lg editbutton" onclick="love();"></button>
                            </form>
                            <?php  $notliked = false; ?>
                            @endif
                            @endforeach
                            @if($notliked)
                            <form id="likeform" action="/like" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                <button class="far fa-heart fa-lg editbutton" onclick="love();"></button>
                            </form>
                            @endif

                            <?php $notsaved =true; ?>
                            @foreach($post->savedposts as $postsave)
                            @if($postsave->id == $id)
                            <form id="saveform" action="/unsave" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                <button class="fas fa-bookmark fa-lg editbutton editbutton2" onclick="save();"></button>
                            </form>
                            <?php  $notsaved = false; ?>
                            @endif
                            @endforeach
                            @if($notsaved)
                            <form id="saveform" action="/save" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                <button class="far fa-bookmark fa-lg editbutton editbutton2" onclick="save();"></button>
                            </form>
                            @endif

                        </div>
                        <p class="likes">{{$post->likes->count()}} likes</p>
                        <div class="scrolled">
                            @foreach($allusers as $alluser)
                            @foreach($post->comments as $comment)
                            @if($comment->user_id == $alluser->id)
                            <p class="description"><span><a
                                        href="<?php echo "/users/".$alluser->id; ?>">{{
                                        $alluser->name }} </a></span> {{ $comment->comment }}</p>
                            <p class="post-time"> {{ $comment->published_at }} </p>
                            @endif
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="form">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="comment-wrapper">
                                <img src="{{ asset('img/smile.PNG') }}" class="icon" alt="">
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                <input type="text" class="comment-box" name="comment" placeholder="Add a comment">
                                <button class="comment-btn" type="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
                @endforeach
                @endforeach
                @if($noPosts)
                <h4 class="mt-4"> Please Follow people to see their posts :)</h4>
                @endif
            </div>
        </div>
    </section>
</body>
<!-- sidebar -->

@endsection