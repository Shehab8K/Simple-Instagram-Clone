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
        <form method="GET" action="/">
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
                        <img class="loggedinPP" src="{{ asset('img/cover 9.png') }}" />
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item " href="/users/{{ $id }}"><span class="dropdownmove">Profile</span></a>
                        <a class="dropdown-item " href="#" style="margin-left: 2px;"><span
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