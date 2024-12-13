@extends('layouts.default') <!-- Extends the default layout for the page -->

@section('title', 'Create Service') <!-- Sets the title for the page -->

@section('content')
    <div class="container mt-5">
        <!-- Success message displayed after a service is successfully created -->
        <div class="card p-5 bg-light text-dark bg-gradient col-md-6 mx-auto" style="border-radius: 15px;">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3 class="text-center text-orange">Create a New Service</h3> <!-- Page title -->

            <!-- Form for creating a new service -->
            <form action="{{ route('services.create') }}" method="POST">
                @csrf <!-- CSRF token for security -->

                <!-- Input field for the service name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Service name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span> <!-- Error message for service name -->
                    @endif
                </div>

                <!-- Textarea for the service description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span> <!-- Error message for description -->
                    @endif
                </div>

                <!-- Dropdown for selecting service category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">-- Select a Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="text-danger">{{ $errors->first('category') }}</span> <!-- Error message for category -->
                    @endif
                </div>

                <!-- Input field for service price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Price" min="0.01" step="0.01">
                    @if ($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span> <!-- Error message for price -->
                    @endif
                </div>

                <!-- Input field for service provider's contact -->
                <div class="mb-3">
                    <label for="contacct" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Contact">
                    @if ($errors->has('contact'))
                        <span class="text-danger">{{ $errors->first('contact') }}</span> <!-- Error message for provider's contact -->
                    @endif
                </div>

                <!-- Checkbox for terms and conditions -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                    <label class="form-check-label" for="terms">I accept the terms and conditions</label>
                    @if ($errors->has('terms'))
                        <span class="text-danger">{{ $errors->first('terms') }}</span> <!-- Error message for terms acceptance -->
                    @endif
                </div>

                <!-- Submit button to save the new service -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 w-100 p-2">Save Service</button>
                </div>

                <!-- Button to return to the services list -->
                <div class="text-center mt-3">
                    <a href="{{ route('services') }}" class="btn btn-secondary">Return to Services</a>
                </div>
            </form>
        </div>
    </div>
@endsection
