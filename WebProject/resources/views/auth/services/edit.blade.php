@extends('layouts.default') <!-- Extends the default layout for the page -->

@section('title', 'Edit Service') <!-- Sets the title for the page -->

@section('content')
    <div class="container mt-5">
        <!-- Card for editing a service -->
        <div class="card p-5 bg-light text-dark bg-gradient col-md-6 mx-auto" style="border-radius: 15px">
            <h3 class="text-center">Edit Service</h3> <!-- Title of the form -->

            <!-- Form to update the service -->
            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf <!-- CSRF token for security -->
                @method('POST') <!-- Used to specify the POST method for form submission -->

                <!-- Input field for service name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $service->name) }}" required>
                </div>

                <!-- Input field for service description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required>{{ old('description', $service->description) }}</textarea>
                </div>

                <!-- Input field for service category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $service->category) }}" required>
                </div>

                <!-- Input field for service price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $service->price) }}" required step="0.01">
                </div>

                <!-- Input field for service provider's contact -->
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $service->contact) }}" required>
                </div>

                <!-- Submit button to update the service -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 w-100 p-2">Update Service</button>
                </div>

                <!-- Button to return to the services list -->
                <div class="text-center mt-3">
                    <a href="{{ route('services') }}" class="btn btn-secondary">Return to Services</a>
                </div>
            </form>
        </div>
    </div>
@endsection
