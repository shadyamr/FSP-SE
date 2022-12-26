<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

@yield('content')
@yield('scripts')

</html>