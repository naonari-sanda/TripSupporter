<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('includes.common.head')
</head>

<body>
    <header>
        @include('includes.common.header')
    </header>


    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>
    <footer>
        @include('includes.common.footer')
    </footer>
    @include('includes.common.modal')

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 400,
            'wrapAround': true
        })
    </script>

    <!-- フラッシュメッセージ -->
    @include('includes.common.flash')

</body>

</html>