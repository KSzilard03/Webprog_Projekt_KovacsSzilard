@extends('layouts.default')

@section('title', 'All Services')

@section('styles')
    <style>
        .list-group a:hover {
            color: orange !important;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">All Services</h3>

        <!-- Category and Price Filter Form -->
        <form method="GET" action="{{ route('services.all') }}" class="mb-4">
            <div class="row justify-content-center">
                <!-- Dropdown for Category Filter -->
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Min Price Filter -->
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
                </div>

                <!-- Max Price Filter -->
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
                </div>

                <!-- Submit Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">OK</button>
                </div>
            </div>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-3">
                <div class="list-group" style="margin-bottom: 1rem">
                    <h5>Categories</h5>
                    @foreach($categories as $category)
                        <a href="{{ route('services.all', ['category' => $category, 'min_price' => request('min_price'), 'max_price' => request('max_price')]) }}"
                           class="list-group-item list-group-item-action {{ request('category') == $category ? 'active' : '' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Right Side (Services) -->
            <div class="col-md-9">
                @if($services->isEmpty())
                    <p class="text-center">No services available with the selected filters.</p>
                @else
                    <!-- Display each service in a narrower container aligned to the left -->
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-md-10 mb-4"> <!-- Adjusted to make the card smaller, but aligned to the left -->
                                <div class="card text-dark bg-light bg-gradient h-100" style="border-radius: 15px">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->name }}</h5>

                                        <!-- Description with additional styling -->
                                        <div style="padding: 0.5rem 0; border-top: 2px solid #9E9E9E; border-bottom: 2px solid #9E9E9E; margin: 1rem 0; font-style: italic">
                                            <p class="card-text">{{ $service->description }}</p>
                                        </div>

                                        <!-- Price, Category, Uploaded By, and Provider's contact -->
                                        <p class="card-text"><strong>Price:</strong> ${{ number_format($service->price, 2) }}</p>
                                        <p class="card-text"><strong>Category:</strong> {{ $service->category }}</p>
                                        <p class="card-text"><strong>Uploaded by:</strong> {{ $service->user->name }}</p>
                                        <p class="card-text"><strong>Contact:</strong> {{ $service->contact }}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        @auth
                                            @if($service->user_id === auth()->user()->id)
                                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('services.delete', $service->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
        </div>

        <!-- Add New Service Button -->
        <div class="text-center mt-4">
            @auth
                <a href="{{ route('services.create') }}" class="btn btn-primary">Add New Service</a>
            @endauth
        </div>
    </div>
@endsection
