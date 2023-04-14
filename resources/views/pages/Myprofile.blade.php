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
                            <a class="dropdown-item far fa-bookmark" href="#" style="margin-left: 2px;"><span
                                    class="dropdownmove">Saved</span> </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            @endauth
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
<link rel="stylesheet" href="{{ URL::asset('css/Myprofile.css') }}">
<script src="https://kit.fontawesome.com/8ba67097ac.js" crossorigin="anonymous"></script>
@section('content')

<body>
    <div class="userContainer">
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
                    @auth
                    <a href="/users/{{auth()->user()->id}}/editprofile"><button type="button"
                            class="btn btn-secondary">Edit Profile</button></a>
                    @endauth
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
            <div class="postType">
                <a href="<?php echo '/users/'.$currentuser->id; ?>"
                    class="special"><i class="fas fa-th"></i> Posts</a>
                <a href="<?php echo '/users/saved/'.$currentuser->id; ?>"
                    class="special2"><i class="far fa-bookmark"></i> Saved</a>
            </div>
            <div class="container">
                <div class="row row-cols-3">
                    @if(isset($savedposts))
                    @foreach($usersavedposts as $post)
                    <a
                        href="<?php echo '/posts/'.$post->id ?>">
                        <div class="col">
                            <img class="GallaryImg"
                                src="<?php echo asset('/storage'.$post->image); ?>">
                        </div>
                    </a>
                    @endforeach
                    @else
                    @foreach($userposts as $userpost)
                    <a
                        href="<?php echo '/posts/'.$userpost->id ?>">
                        <div class="col">
                            <img class="GallaryImg"
                                src="<?php echo asset('/storage/'.$userpost->image); ?>">
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>

        </section>
    </div>
</body>
@endsection