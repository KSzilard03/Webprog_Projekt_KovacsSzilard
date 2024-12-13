@extends('layouts.default') <!-- Extends the default layout for this page -->

@section('title', 'Home') <!-- Sets the title for this page -->

<style>
    .hero-section {
        /* Set background image, centered and covering the whole section */
        background: url('https://cdn.vectorstock.com/i/500p/07/85/city-skyline-silhouette-vector-26470785.jpg') no-repeat center center;
        background-size: cover; /* Ensure the image covers the entire section */
        background-position: center; /* Center the background image */
        /* Set full viewport height and width for the section */
        height: 100vh;
        width: 100%;
        padding: 0; /* Remove default padding */
        /* Flexbox to center content horizontally and vertically */
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center; /* Center the text inside */
        /* Apply a border radius to soften the edges */
        border-radius: 15px;
    }
    .hero-section h3 {
        color: orange; /* Change main text color to orange on hover */
        font-size: clamp(2.5rem, 6vw, 4rem); /* Minimum 2.5rem, maximum 4rem, and adjusts based on the viewport width */
        font-weight: bold; /* Make the title bold */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Add text shadow for better contrast */
    }
    .hero-section p {
        color: white; /* Change secondary text color to white */
        font-size: clamp(1.2rem, 4vw, 2rem); /* Minimum 1.2rem, maximum 2rem, adjusts based on viewport width */
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7); /* Add text shadow to make it stand out */
    }
</style>

@section('content')
    <div class="container mt-5"> <!-- Main container with margin top -->

        <!-- Hero Section -->
        <div class="hero-section text-center text-white">
            <section class="mt-5 text-center">
                @auth
                    <h3>Welcome back! Ready to explore?</h3>
                    <p>Click here to see all services!</p>
                    <a href="{{ route('services.all') }}" class="btn btn-primary btn-lg">Services</a> <!-- If logged in, link to services -->
                @else
                    <h3>Join Us and Start Exploring</h3>
                    <p>Sign up today to get access to all the services we offer.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Sign Up Now</a> <!-- If not logged in, show sign up button -->
                @endauth
            </section>
        </div>

        <!-- Latest Services Section -->
        <h3 class="mt-5">Latest Services</h3> <!-- Subheading for the latest services section -->
        @if($latestServices->isEmpty()) <!-- Checks if there are no services -->
        <p>No services available at the moment.</p> <!-- Message when no services are found -->
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4"> <!-- Bootstrap grid to display services -->
                @foreach($latestServices as $service) <!-- Loop through each service in $latestServices -->
                <div class="col"> <!-- Each service item is in its own column -->
                    <div class="card text-dark bg-light bg-gradient h-100" style="border-radius: 15px"> <!-- Card for each service -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5> <!-- Service name -->
                            <!-- Description with separate style, highlighted -->
                            <div style="padding: 0.5rem 0; border-top: 2px solid #9E9E9E; border-bottom: 2px solid #9E9E9E; margin: 1rem 0; font-style: italic">
                                <p class="card-text">{{ $service->description }}</p> <!-- Service description -->
                            </div>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($service->price, 2) }}</p> <!-- Service price -->
                            <p class="card-text"><strong>Category:</strong> {{ $service->category }}</p> <!-- Service category -->
                            <p class="card-text"><strong>Uploaded by:</strong> {{ $service->user->name }}</p> <!-- Service uploaded by -->
                            <p class="card-text"><strong>Contact:</strong> {{ $service->contact }}</p> <!-- Provider's contact -->
                        </div>
                        <div class="card-footer text-center">
                            @auth <!-- Checks if the user is authenticated -->
                            @if($service->user_id === auth()->user()->id) <!-- Checks if the service belongs to the current user -->
                            <!-- Edit and Delete buttons for services created by the current user -->
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('services.delete', $service->id) }}" method="POST" style="display:inline;">
                                @csrf <!-- CSRF protection -->
                                @method('DELETE') <!-- Method spoofing for DELETE -->
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button> <!-- Delete button -->
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
