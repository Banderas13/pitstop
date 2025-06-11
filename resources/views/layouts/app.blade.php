<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Pitstop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Pitstop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    @auth
                        @if(Auth::user()->name != null)
                            <li class="nav-item">
                                <a class="nav-link active" href="/">Wagens</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/">Mechaniekers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/">Service</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/">account</a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link active">Logout</button>
                            </form>
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="/">Service</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/">account</a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link active">Logout</button>
                            </form>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container py-4">
        @yield('content')
    </div>
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-1">&copy;Pitstop 2025-{{ date('Y') }}. Alle rechten voorbehouden.</p>
            <small>De slimme manier om bestuurders en monteurs te verbinden.</small>
        </div>
        <div class="container text-center">
            <br><a href="/contact" class="nav-item">Contact</a>
            <br><a href="/about" class="nav-item">over ons</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
