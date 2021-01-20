<nav class="navbar navbar-expand-md navbar-light  bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-dark font-weight-bold" href="{{ route('main') }}">
            <i class="fas fa-globe-americas mr-1"></i>{{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-center">
                <!-- Authentication Links -->
                <li class="nav-item">
                    @auth
                    <a class="nav-link text-dark" href="{{ route('user.list') }}">
                        <i class="fas fa-users mr-1"></i>ユーザー一覧
                    </a>
                    @else
                    <a class="nav-link text-dark" data-toggle="modal" data-target="#guestModal">
                        <i class="fas fa-users mr-1"></i>ユーザー一覧
                    </a>
                    @endauth
                </li>
                <li class="nav-item">
                    <a href="{{ route('ranking') }}" class="nav-link text-dark"><i class="fas fa-chart-line mr-1"></i>ランキング</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link text-dark">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link text-dark">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class=" nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark d-flex align-items-center font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if(!empty(Auth::user()->acount->icon))
                        <img class="cycle header-img" src="{{ asset('/storage/' . Auth::user()->acount->icon ) }}" alt="ユーザーアイコン" />
                        @elseif(optional(Auth::user()->acount)->gender == "男性")
                        <img class="cycle header-img img-thumbnail" src="{{ asset('/storage/men.png') }}" alt="男性アイコン" />
                        @elseif(optional(Auth::user()->acount)->gender === "女性")
                        <img class="cycle header-img img-thumbnail" src="{{ asset('/storage/women.png') }}" alt="女性アイコン" />
                        @else
                        <img class="cycle header-img img-thumbnail" src="{{ asset('/storage/none.png') }}" alt="アイコン" />
                        @endif
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right bg-white" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-dark text-center" href="{{ route('user', Auth::id()) }}">
                            マイページ
                        </a>
                        <a class="dropdown-item text-dark text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> 