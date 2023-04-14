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
@section('title', 'Edit Profile')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="{{ URL::asset('css/editprofile.css') }}">
<script src="https://kit.fontawesome.com/8ba67097ac.js" crossorigin="anonymous"></script>
@section('content')

<body>
    <div class="editcontainer">
        <div class="topOptions">
            <a class="special selected" href="/users/{{auth()->user()->id}}/editprofile">Edit Profile</a>
            <a class="pwdMoveLeft special" href="/users/{{auth()->user()->id}}/editpassword">Change Password</a>
        </div>
        <div class="restcontent">
            <div class="changeimg">
                <div class="rightContent"><img class="editPP" src="{{asset ('img/cover 6.PNG')}}" /></div>
                <div class="leftContent">
                    <h4>Username</h4>
                    <a href="/users/{{auth()->user()->id}}/editprofilepicture">Change Profile Photo</a>
                </div>
            </div>
            <div class="form">

                <form action="/users/{{auth()->user()->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" value="{{ $users->name }}" />
                    <br />
                    <label for="username">username</label>
                    <input name="username" id="username" type="text" value="{{ $users->username }}" />
                    <br />
                    <label for="website">Website</label>
                    <input name="website" id="website" type="text" value="{{ $users->website }}" />
                    <br />
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio"
                        type="text"><?php echo $users->bio ?></textarea>
                    <br />
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" value="{{ $users->email }}" />

                    <br />
                    <label for="phonenumber">Phone Number</label>
                    <input name="phone" id="phonenumber" type="text" value="{{ $users->phone }}" />
                    <br />
                    <div class="genderleft">
                        <label for="gender">Gender</label>
                        <?php
                $selectedmale = null;
                                $selectedfemale = null;
                                if ($users->gender == 'male') {
                                    $selectedmale = "selected";
                                } elseif ($users->gender == 'female') {
                                    $selectedfemale = "selected";
                                }
                                ?>
                        <select id="gender" name="gender">
                            <option selected disabled></option>
                            <option {{ $selectedmale }} value="male">Male</option>
                            <option {{ $selectedfemale }} value="female">Female</option>
                        </select>
                    </div>
                    <div class="moverightbutton">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
            @endauth
        </div>
    </div>
</body>
@endsection