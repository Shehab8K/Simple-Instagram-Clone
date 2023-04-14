<header>
    <nav class="navbar">
    <div class="nav-wrapper">
        <img src="{{ asset('img/logo.PNG') }}" class="brand-img" alt="">

                            <form method="POST" action="/searcheduser">
                            @csrf
                            <input type="text" class="search-box" placeholder="search" name="searchedUser"> 
                            </form>
        <div class="nav-items">
            <a href="/home"><img src= "{{ asset ('img/home.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/messenger.PNG') }}" class="icon" alt=""></a>
            <a href="/posts/create"><img src= "{{ asset ('img/add.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/explore.PNG') }}" class="icon" alt=""></a>
            <a href="#"><img src= "{{ asset ('img/like.PNG') }}" class="icon" alt=""></a>
            <div class="icon user-profile">
            <div class="btn-group">
            <button type="button" class="userPPbutton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="loggedinPP" src="<?php echo asset('/storage'.$currentuser->avatar) ?>"/>
            </button>
            <div class="dropdown-menu">
                    @auth
                    <a class="dropdown-item far fa-user-circle" href="/users/{{auth()->user()->id}}"><span class="dropdownmove">Profile</span></a>
                    @endauth
                    <a class="dropdown-item far fa-bookmark" href="#" style="margin-left: 2px;"><span class="dropdownmove">Saved</span> </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
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
    </div>
</nav>
    </header>
@extends('layouts.app')
@section('title', 'Profile')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ URL::asset('css/profile.css') }}">
@section('content')
<body>
<div class="userContainer">
    <section class="userUpperPart">
        <br/><br/>
            <h3 style="text-align: center;">{{$tags[0]->tag}}</h3>
    </section>
    <section class="gallery">
    <hr class="noFloat"/>
         <div class="container">
             <div class="row row-cols-3">
                    @foreach($tags as $tag)
                    <a href="<?php echo '/posts/'.$tag->post->id; ?>"><div class="col">
                     <img class="GallaryImg" src="<?php echo asset('/storage'.$tag->post->image); ?>">
                    </div></a>
                    @endforeach
            </div>
        </div>

    </section>
</div>
</body>
@endsection