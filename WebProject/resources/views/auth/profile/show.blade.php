@extends("layouts.default") <!-- Extends the default layout for the page -->

@section("title", "View Profile") <!-- Sets the title of the page -->

@section("content")
    <style>
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
        }
    </style>

    <div class="container mt-5">
        <!-- Profile card displaying user's information -->
        <div class="card p-5 bg-light text-dark bg-gradient col-md-6 mx-auto text-center" style="border-radius: 15px">
            <h3>View Profile</h3>

            <!-- Profile picture display: uses stored image or placeholder if none exists -->
            <div class="mb-3">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="profilePicture" class="profile-picture">
                @else
                    <img src="https://via.placeholder.com/150" alt="profilePicture" class="profile-picture">
                @endif
            </div>

            <!-- Display user information: username, email, and user type -->
            <h4>Username: {{ auth()->user()->name }}</h4>
            <p>E-mail address: {{ auth()->user()->email }}</p>
            <p>User Type: {{ auth()->user()->user_type == 1 ? 'Searcher' : 'Servicer' }}</p>

            <!-- Button to edit profile -->
            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>
@endsection
