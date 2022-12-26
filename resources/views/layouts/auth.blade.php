<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        @yield('content')
    </main>
    @yield('scripts')
</body>

</html>