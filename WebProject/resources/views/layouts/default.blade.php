<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for the page -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensures responsive design for mobile devices -->
    <title>@yield('title') - WebProject</title> <!-- Dynamically sets the title of the page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Link to Bootstrap CSS for styling -->

    <style>
        .navbar-nav .nav-link:hover {
            color: orange !important; /* Change text color to orange on hover */
        }
    </style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Bootstrap navbar with dark background -->
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">WebProject</a> <!-- Link to the home page -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Icon for the mobile navbar toggle -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto"> <!-- List of navigation items, aligned to the right -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a> <!-- Link to home -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.all') }}">Services</a> <!-- Link to services page -->
                </li>

                @guest <!-- Shows the following items if the user is not authenticated -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a> <!-- Link to login page -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a> <!-- Link to register page -->
                </li>
                @endguest

                @auth <!-- Shows the following items if the user is authenticated -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li> <!-- Link to the user profile -->
                        <li><a class="dropdown-item" href="{{ route('services') }}">My Services</a></li> <!-- Link to the user's services page -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0"> <!-- Logout form -->
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button> <!-- Logout button -->
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Main content -->
<div class="container mt-4">
    @yield('content') <!-- Placeholder for dynamic content -->
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5"> <!-- Dark footer with white text -->
    <div class="container text-center">
        <p class="mb-0">&copy; {{ date('Y') }} WebProject - Szilárd Kovács. All rights reserved.</p> <!-- Current year -->
        <div>
            <a href="#" class="text-white text-decoration-none">Privacy Policy</a> | <!-- Privacy policy link -->
            <a href="#" class="text-white text-decoration-none">Terms of Service</a> <!-- Terms of service link -->
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS for interactive components -->
</body>
</html>
