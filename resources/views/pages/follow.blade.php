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
@section('title', 'My Profile')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="{{ URL::asset('css/follow.css') }}">
<script src="https://kit.fontawesome.com/8ba67097ac.js" crossorigin="anonymous"></script>
@section('content')

<body>
    <div class="followContainer">
        @if(isset($showfollower))
        <h3 class="titlef">Followers</h3>
        <ul class="listedf">
            @foreach($followers as $follower)
            <li>
                <?php
                 $followed = false;
                                ?>
                <span class="usernamef">{{ $follower->name }}</span>

                @if($follower->id == $myid)
                <a href="/users/{{$myid}}"><button type="button" class="btn btn-secondary followuser">My
                        profile</button></a>

                @elseif(isset($myfollowings) && isset($myfollowers))
                @foreach($myfollowings as $myfollowing)
                @if($follower-> id == $myfollowing->id)
                <form class="followuser" action="/unfollow/{{ $follower-> id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Unfollow</button>
                </form>
                <?php $followed = true; ?>
                @endif
                @endforeach

                @foreach($myfollowers as $myfollower)
                @if($follower->id == $myfollower->id && !$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $follower-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow Back</button>
                </form>
                <?php  $followed =true; ?>
                @endif
                @endforeach
                @if(!$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $follower-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
                @endif


                @elseif(isset($myfollowings))
                @foreach($myfollowings as $myfollowing)
                @if($follower-> id == $myfollowing->id)
                <form class="followuser" action="/unfollow/{{ $follower-> id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Unfollow</button>
                </form>
                <?php $followed = true; ?>
                @endif
                @endforeach

                @if(!$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $follower-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
                @endif

                @elseif(isset($myfollowers))
                @foreach($myfollowers as $myfollower)
                @if($follower->id == $myfollower->id && !$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $follower-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow Back</button>
                </form>
                <?php  $followed =true; ?>
                @endif
                @endforeach
                @if(!$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $follower-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
                @endif

                @endif
            </li>
            @endforeach
        </ul>
        @endif

        <!-- show following -->

        @if(isset($showfollowing))
        <h3 class="titlef">Followings</h3>
        <ul class="listedf">
            @foreach($followings as $following)
            <li>
                <?php
                                 $followed = false;
                                ?>
                <span class="usernamef">{{ $following->name }}</span>

                @if($following->id == $myid)
                <a href="/users/{{$myid}}"><button type="button" class="btn btn-secondary followuser">My
                        profile</button></a>

                @elseif(isset($myfollowings) && isset($myfollowers))
                @foreach($myfollowings as $myfollowing)
                @if($following-> id == $myfollowing->id)
                <form class="followuser" action="/unfollow/{{ $following-> id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Unfollow</button>
                </form>
                <?php $followed = true; ?>
                @endif
                @endforeach

                @foreach($myfollowers as $myfollower)
                @if($following->id == $myfollower->id && !$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $following-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow Back</button>
                </form>
                <?php  $followed =true; ?>
                @endif
                @endforeach
                @if(!$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $following-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
                @endif


                @elseif(isset($myfollowings))
                @foreach($myfollowings as $myfollowing)
                @if($following-> id == $myfollowing->id)
                <form class="followuser" action="/unfollow/{{ $following-> id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Unfollow</button>
                </form>
                <?php $followed = true; ?>
                @endif
                @endforeach

                @if(!$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $following-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
                @endif

                @elseif(isset($myfollowers))
                @foreach($myfollowers as $myfollower)
                @if($following->id == $myfollower->id && !$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $following-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow Back</button>
                </form>
                <?php  $followed =true; ?>
                @endif
                @endforeach
                @if(!$followed)
                <form class="followuser" action="/follow" method="POST">
                    @csrf
                    <input type="hidden" name="followed_id" value="{{ $following-> id }}" />
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
                @endif

                @endif
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</body>
@endsection