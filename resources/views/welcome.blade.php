@extends('layouts.welcome')

@section('custom_css')
<style>
    a,
    a:focus,
    a:hover {
        color: #fff;
    }

    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
        color: #333;
        text-shadow: none;
        /* Prevent inheritance from `body` */
    }

    html,
    body {
        height: 100%;
        background: url(img/bg.png) no-repeat center center fixed;
        max-width: 100%;
    }

    body {
        display: flex;
        color: #fff;
        text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
    }

    .cover-container {
        max-width: 42em;
    }

    .masthead {
        margin-bottom: 2rem;
    }

    .masthead-brand {
        margin-bottom: 0;
    }

    .nav-masthead .nav-link {
        padding: .25rem 0;
        font-weight: 700;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        border-bottom: .25rem solid transparent;
    }

    .nav-masthead .nav-link:hover,
    .nav-masthead .nav-link:focus {
        border-bottom-color: rgba(255, 255, 255, .25);
    }

    .nav-masthead .nav-link+.nav-link {
        margin-left: 1rem;
    }

    .nav-masthead .active {
        color: #fff;
        border-bottom-color: #fff;
    }

    @media (min-width: 48em) {
        .masthead-brand {
            float: left;
        }

        .nav-masthead {
            float: right;
        }
    }

    .cover {
        padding: 0 1.5rem;
    }

    .cover .btn-lg {
        padding: .75rem 1.25rem;
        font-weight: 700;
    }

    .mastfoot {
        color: rgba(255, 255, 255, .5);
    }
</style>
@endsection

@section('content')

<body class="text-center d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header role="banner" class="masthead mb-auto">
            <div class="inner">
                <h3 class="float-md-start mb-0">{{ config('app.name', 'Laravel') }}</h3>
                @if (Route::has('login'))
                <nav role="navigation" class="nav nav-masthead justify-content-center float-md-end">
                    @auth
                    <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                    @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>
        </header>

        <main role="main">
            <h1 class="fw-bold">Easy way to manage productivity!</h1>
            <p class="lead">Welcome to {{ config('app.name', 'Laravel') }}'s internal enterprise resource planning.</p>
            <p class="lead px-3">Drive performance and your cross-functional collaboration with easy-to-use dashboards, automations, and automated insights in one click.</p>
        </main>

        <footer role="contentinfo" class="mastfoot mt-auto">
            <div class="inner">
                <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
            </div>
        </footer>
    </div>
</body>
@endsection