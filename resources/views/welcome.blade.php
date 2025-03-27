<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TutorsHub Your No ! for Personal Tutors') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('build/assets/app-DqME6eCz.css') }}"> 
        <script src="{{ asset('build/assets/app-D-03kJxt.js') }}"></script>
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
        </nav> --}}

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm text-dark">
            <div class="container p-1">
                <!-- Logo -->
                <a class="navbar-brand me-5 fw-bold" href="{{ url('/') }}">Tutors Hub
                    <img src="/path/to/logo.png" alt="" height="40">
                </a>

                <!-- Navbar Toggle Button for Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse ms-4 fw-bold " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="/parent">Parent</a></li>
                        <li class="nav-item"><a class="nav-link" href="/tutor">Tutor</a></li>
                        <li class="nav-item"><a class="nav-link" href="/promotion">Promotion</a></li>
                        <li class="nav-item"><a class="nav-link" href="/mytutor-online">MyTutor Online</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-outline-primary px-4" href="{{ route('login') }}">Sign In</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
        {{-- <main class="py-4">
            @yield('content')
        </main> --}}

        {{-- Hero start --}}
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold">
                        The Best Personal Tuition in Malaysia</h2>
                    <p class="text-muted mt-3 fs-4">
                        Tutors Hub has been created to bridge the gap in education by providing children with the
                        support they need to learn better and enhance their understanding. Recognizing that every
                        student has unique learning needs, Tutors Hub focuses on personalized tutoring to ensure that no
                        child is left behind.
                    </p>
                    <p class="text-muted fs-4">
                        By offering structured guidance, interactive lessons, and tailored
                        learning approaches, Tutors Hub aims to make education more accessible and effective. The
                        platform is dedicated to nurturing curiosity, strengthening foundational knowledge, and boosting
                        confidence, ultimately empowering students to excel academically and beyond.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <div class="p-3 bg-light rounded shadow-sm">
                            <h4 class="text-primary mb-1">15,193</h4>
                            <p class="mb-0 text-muted">Tutors</p>
                        </div>
                        <div class="p-3 bg-light rounded shadow-sm">
                            <h4 class="text-primary mb-1">36,741</h4>
                            <p class="mb-0 text-muted">Success Classes</p>
                        </div>
                        <div class="p-3 bg-light rounded shadow-sm">
                            <h4 class="text-primary mb-1">174,425</h4>
                            <p class="mb-0 text-muted">Hours of 1-to-1 Tuition</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center mt-4 mt-md-0">
                    <img src="{{ asset('images/positive-public-school-culture.jpeg') }}" alt="Happy Students" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>

        {{-- hero end --}}

        {{-- our services start --}}
        <div class="container text-center my-5">
            <h2 class="fw-bold">Our Service Categories</h2>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="service-card p-4">
                        <img src="{{ asset('images/one-v-one-home-tutoring.png') }}" width="260px" height="155px" alt="Home Tuition">
                        <h5>One-to-One Home Tutoring</h5>
                        <button class="btn btn-outline-primary mt-3 rounded-pill">More Info</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card p-4">
                        <img src="{{  asset('images/one-v-1-online-tutoring.png') }}" width="225px" height="155px" alt="Online Tuition">
                        <h5>One-to-One Online Tutoring</h5>
                        <button class="btn btn-outline-primary mt-3 rounded-pill">More Info</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card p-4">
                        <img src="{{  asset('images/further-studies.svg') }}" width="325px" height="155px" alt="Career Path">
                        <h5>Further Study & Career Path</h5>
                        <button class="btn btn-outline-primary mt-3 rounded-pill">More Info</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card p-4">
                        <img  src="{{  asset('images/univeristy-tutoring.png') }}" width="225px" height="155px" alt="University Tutoring">
                        <h5>University/College Student Tutoring</h5>
                        <button class="btn btn-outline-primary mt-3 rounded-pill">More Info</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- our services end  --}}

    </div>

    <style>
        .service-card { 
            border-radius: 10px;
            padding: 20px;
            background: #f8f9fa;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            background-color: #aad9f8;
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
        .service-card img {
            max-width: 100px;
            margin-bottom: 15px;
        }
    </style>
</body>

</html>
