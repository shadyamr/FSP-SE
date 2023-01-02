<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-dark" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('home')) ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>

                        @if (Auth::user()->hasRole('sales') || Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('requests*')) ? 'active' : '' }}" href="{{ route('requests') }}">{{ __('Requests') }}</a>
                        </li>
                        @endif
                        @if (Auth::user()->hasRole('inspector') || Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('inspections*')) ? 'active' : '' }}" href="{{ route('inspections') }}">{{ __('Inspections') }}</a>
                        </li>
                        @endif
                        @if (Auth::user()->hasRole('stock') || Auth::user()->hasRole('admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="stockDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Stock Management
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="stockDropDown">
                                <li><a class="dropdown-item" href="{{ route('category') }}">{{ __('Categories') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('item') }}">{{ __('Stock Items') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('supplier') }}">{{ __('Suppliers') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('borrower') }}">{{ __('Borrowers') }}</a></li>
                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->hasRole('accountant') || Auth::user()->hasRole('admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->is('accounting*')) ? 'active' : '' }}" href="#" id="accountingDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Accounting
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="accountingDropDown">
                                <li><a class="dropdown-item" href="{{ route('accounting.invoice') }}">{{ __('Invoices') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('accounting.salaries') }}">{{ __('Salaries') }}</a></li>
                                <!--<li><a class="dropdown-item" href="#">{{ __('Generate Reports') }}</a></li>-->
                            </ul>
                        </li>
                        @endif   
                        @if (Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('employees*')) ? 'active' : '' }}" href="{{ route('employees') }}">{{ __('Employee Management') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('logs')) ? 'active' : '' }}" href="{{ route('logs') }}">{{ __('Logging') }}</a>
                        </li>
                        @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
    @yield('scripts')
</body>

</html>