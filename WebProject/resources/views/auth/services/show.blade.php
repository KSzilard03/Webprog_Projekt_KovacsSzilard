@extends('layouts.default') <!-- Extends the default layout for the page -->

@section('title', 'Your Services') <!-- Sets the title for the page -->

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Your Services</h3> <!-- Heading for the user's services page -->

        <!-- Success Message for Actions (e.g., adding, editing, or deleting services) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Message if User Has No Services -->
        @if($services->isEmpty())
            <p class="text-center">You haven't added any services yet.</p>
        @else
            <!-- Displaying the List of User's Services -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($services as $service)
                    <div class="col">
                        <div class="card text-dark bg-light bg-gradient h-100" style="border-radius: 15px">
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text">{{ $service->description }}</p>
                                <p class="card-text"><strong>Category:</strong> {{ $service->category }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ number_format($service->price, 2) }}</p>
                                <p class="card-text"><strong>Contact:</strong> {{ $service->contact }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <!-- Links to Edit and Delete Service -->
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('services.delete', $service->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Button to Add a New Service -->
        <div class="text-center mt-4">
            <a href="{{ route('services.create') }}" class="btn btn-primary">Add New Service</a>
        </div>
    </div>
@endsection
