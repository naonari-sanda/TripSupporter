<nav class="navbar navbar-expand-md navbar-light  bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-dark" href="{{ route('main') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="modal">ランキング</a>
                </li>
                <li class=" nav-item dropdown select">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle delete text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        地域別国
                    </a>

                    <div class="dropdown-menu dropdown-menu-right bg-white" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-dark" href="#">
                            アジア
                        </a>
                        <a class="dropdown-item text-dark" href="#">
                            アフリカ
                        </a><a class="dropdown-item text-dark" href="#">
                            ヨーロッパ
                        </a>
                        </a><a class="dropdown-item text-dark" href="#">
                            アメリカ大陸
                        </a>
                    </div>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right bg-white" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-dark" href="{{ route('mypage') }}">
                            マイページ
                        </a>
                        <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
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