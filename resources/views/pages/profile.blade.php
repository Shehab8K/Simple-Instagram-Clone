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
@section('title', 'Profile')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="{{ URL::asset('css/profile.css') }}">
@section('content')

<body>
    <div class="userContainer">
        <?php
     $followed = false;
                                ?>
        <section class="userUpperPart">
            <div class="leftContent">
                @if($users->avatar == null)
                <img class="userImgView"
                    src="<?php echo asset('/storage/'."avatars/default.png"); ?>"
                    alt="User Image" />
                @else
                <img class="userImgView"
                    src="<?php echo asset('/storage/'.$users->avatar); ?>"
                    alt="User Image" />
                @endif
            </div>
            <div class="profile-info">
                <div class="first-line">
                    <span class="username">{{ $users->username}}</span>
                    @if(isset($followers[0]))
                    @foreach($followers as $follower)
                    @if($follower->id == $id)
                    <form action="/unfollow/{{ $users->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $users->id }}" />
                        <input type="hidden" name="follower_name" value="{{ $currentuser->name }}" />
                        <input type="hidden" name="followed_name" value="{{ $users->name }}" />
                        <button type="submit" class="btn btn-primary">Unfollow</button>
                    </form>
                    <?php $followed=true; ?>
                    @endif
                    @endforeach
                    @endif

                    @if(isset($followings[0]))
                    @foreach($followings as $following)
                    @if($following->id == $id && !$followed)
                    <form action="/follow" method="POST">
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $users->id }}" />
                        <input type="hidden" name="follower_name" value="{{ $currentuser->name }}" />
                        <input type="hidden" name="followed_name" value="{{ $users->name }}" />
                        <button type="submit" class="btn btn-primary">Follow Back</button>
                    </form>
                    <?php $followed=true; ?>
                    @endif
                    @endforeach
                    @endif

                    @if(!$followed)
                    <form action="/follow" method="POST">
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $users->id }}" />
                        <input type="hidden" name="follower_name" value="{{ $currentuser->name }}" />
                        <input type="hidden" name="followed_name" value="{{ $users->name }}" />
                        <button type="submit" class="btn btn-primary">Follow</button>
                    </form>
                    <?php $followed =true; ?>
                    @endif
                </div>
                <div class="second-line">
                    <span class="p1"><span class="NoPosts">{{ $users->no_of_posts}}</span> Post</span>
                    <a href="/followers/{{ $users->id }}"><span class="p2"><span
                                class="NoFollowers">{{$followerscount}}</span> Followers</span></a>
                    <a href="/following/{{ $users->id }}"><span class="p3"><span
                                class="NoFollowing">{{$followingscount}}</span> Following</span></a>
                </div>
                <div class="third-line">
                    <p>{{ $users->bio}}</p>
                    <a href="{{ $users->website }}">{{ $users->website}}</a>
                </div>
            </div>
        </section>
        <section class="gallery">
            <hr class="noFloat" />
            <div class="container">
                <div class="row row-cols-3">
                    @foreach($userposts as $userpost)
                    <a
                        href="<?php echo '/posts/'.$userpost->id ?>">
                        <div class="col">
                            <img class="GallaryImg"
                                src="<?php echo asset('/storage'.$userpost->image); ?>">
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

        </section>
    </div>
</body>
@endsection