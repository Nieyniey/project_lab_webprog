<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
        }

        .btn-login {
            color: #333;
            margin-right: 15px;
            font-weight: 500;
            text-decoration: none !important;
        }

        .btn-signup {
            background: #ff4d8d;
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 600;
            border: none;
        }

        .user-dropdown-toggle {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
        }

        .user-dropdown-toggle:hover {
            color: #000;
        }

        .user-dropdown-menu {
            width: 180px;
            border-radius: 12px;
            padding: 8px 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
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
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#777" viewBox="0 0 16 16">
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
        <a class="nav-link-custom" href="#">About Us</a>

        {{-- If NOT logged in --}}
        @guest
            <a href="/login" class="btn-login">Log in</a>
            <a href="/register" class="btn-signup">Sign up</a>
        @endguest

        {{-- If logged in --}}
        @auth
            <div class="dropdown ms-3">
                <a href="#" class="user-dropdown-toggle" id="userMenu" data-bs-toggle="dropdown">
                    Hello, {{ Auth::user()->name }}
                    <span class="arrow">&#9662;</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu">
                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                    <li><a class="dropdown-item" href="/mybookings">My Bookings</a></li>
                    <li><a class="dropdown-item" href="/favorites">Favorites</a></li>
                    <li><a class="dropdown-item" href="/addproperty">Add Property</a></li>
                    <li><a class="dropdown-item" href="/myproperties">My Properties</a></li>
                    
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </nav>

    {{-- GLOBAL FLASH MESSAGE SECTION --}}
    <div class="container mt-3">

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>

    {{-- Page Content --}}
    <div>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
