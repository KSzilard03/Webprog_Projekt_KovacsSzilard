@extends("layouts.default") <!-- Extends the default layout for the page -->

@section("title", "Edit Profile") <!-- Sets the title of the page -->

@section("content")
    <div class="container mt-5">
        <div class="card p-5 bg-light text-dark bg-gradient col-md-6 mx-auto" style="border-radius: 15px">
            <!-- Display success message if profile update is successful -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3 class="text-center">Edit Profile</h3>

            <!-- Form for updating user profile -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Username input field -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', auth()->user()->name) }}" required>
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <!-- Email input field -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- New password input field -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Password confirmation input field -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <!-- User type selection (Searcher or Servicer) -->
                <div class="mb-3">
                    <label for="user_type" class="form-label">User Type</label>
                    <select id="user_type" name="user_type" class="form-select">
                        <option value="1" {{ old('user_type', auth()->user()->user_type) == 1 ? 'selected' : '' }}>Searcher</option>
                        <option value="2" {{ old('user_type', auth()->user()->user_type) == 2 ? 'selected' : '' }}>Servicer</option>
                    </select>
                    @if ($errors->has('user_type'))
                        <span class="text-danger">{{ $errors->first('user_type') }}</span>
                    @endif
                </div>

                <!-- Profile picture upload field -->
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Update Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    <small class="form-text text-muted">JPEG, PNG or GIF format picture.</small>
                    @if ($errors->has('profile_picture'))
                        <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
                    @endif
                </div>

                <!-- Submit button to update the profile -->
                <div class="text-center">
                    <input type="submit" value="Profil Frissítése" class="btn btn-primary mt-3 w-100 p-2">
                </div>

                <!-- Button to go back to profile view -->
                <div class="text-center mt-3">
                    <a href="{{ route('profile') }}" class="btn btn-secondary">Return To Profile</a>
                </div>
            </form>
        </div>
    </div>
@endsection
