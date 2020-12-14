<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('includes.head')
</head>

<body>
    <header>
        @include('includes.header')
    </header>


    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>
    <footer>
        @include('includes.footer')
    </footer>
    @include('includes.modal')


    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <!-- フラッシュメッセージ -->
    @include('includes.alert')
</body>

</html>