<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>AirInS</title>

    <style>
        .navbar-airins {
            padding: 15px 40px;
            background: white;
            border-bottom: 1px solid #eee;
        }

        .nav-logo {
            font-size: 26px;
            font-weight: 700;
            color: #ff4d8d;
            margin-right: 25px;
            text-decoration: none;
        }

        .search-box {
            flex: 1;
            display: flex;
            align-items: center;
            background: #f6f5f7;
            border-radius: 40px;
            padding: 7px 18px;
            margin-right: 40px;
        }

        .search-box input {
            border: none;
            background: transparent;
            width: 100%;
            padding-left: 8px;
        }

        .search-box input:focus {
            outline: none;
        }

        .nav-link-custom {
            margin-right: 20px;
            color: #333;
            font-weight: 500;
            text-decoration: none !important;
            color: inherit !important;
        }

        .btn-login {
            color: #333;
            margin-right: 15px;
            font-weight: 500;
            text-decoration: none !important;
            color: inherit !important;
        }

        .btn-signup {
            background: #ff4d8d;
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 600;
            border: none;
            text-decoration: none !important;
        }
    </style>
</head>

<body>

    {{-- NAVBAR AIRINS --}}
    <nav class="navbar-airins d-flex align-items-center">
        
        {{-- Logo --}}
        <a href="/" class="nav-logo">AirInS</a>

        {{-- Search Box --}}
        <div class="search-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#777" class="" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 
                1.398h-.001l3.85 3.85a1 1 0 0 0 
                1.415-1.414l-3.85-3.85zm-5.242 
                1.656a5 5 0 1 1 0-10 5 5 0 
                0 1 0 10z"/>
            </svg>

            <form action="{{ route('search') }}" method="GET" class="d-flex search-form flex-fill">
                <input 
                    type="text" 
                    name="q" 
                    class="form-control border-0 bg-transparent"
                    placeholder="Search properties..."
                    value="{{ request('q') }}"
                >
            </form>

        </div>

        {{-- Navigation --}}
        <a class="nav-link-custom" href="#">About</a>

        {{-- If NOT logged in --}}
        @guest
            <a href="/login" class="btn-login">Log in</a>
            <a href="/register" class="btn-signup">Sign up</a>
        @endguest

        {{-- If logged in --}}
        @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn-signup">Logout</button>
            </form>
        @endauth


    </nav>

    {{-- Page Content --}}
    <div>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
