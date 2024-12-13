@extends("layouts.default") <!-- Extends the default layout for the page -->

@section("title", "Register") <!-- Sets the title for the page -->

@section("content")
    <!-- Container to center the form both vertically and horizontally using flexbox -->
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" id="template-bg-3">

        <!-- Display an error message if there is an issue with the registration process -->
        @if(session()->has("error"))
            <div class="alert alert-danger">
                {{ session()->get("error") }}
            </div>
        @endif

        <!-- Card for the registration form -->
        <div class="card text-dark bg-light mb-5 p-5 bg-light bg-gradient col-md-4" style="border-radius: 15px">
            <div class="card-header text-center" style="background-color: #f8f9fa;"> <!-- Card header background color matching card -->
                <h3>Register</h3> <!-- Title of the registration form -->
            </div>
            <div class="card-body mt-3">
                <!-- Form for user registration -->
                <form name="register" action="{{ route('register.post') }}" method="POST">
                    @csrf <!-- CSRF token for security -->

                    <!-- Input field for the username -->
                    <div class="input-group form-group mt-3">
                        <input type="text" class="form-control text-center p-3" placeholder="Username" id="username" name="username">

                        <!-- Display error message for username -->
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <!-- Input field for the email -->
                    <div class="input-group form-group mt-3">
                        <input type="text" class="form-control text-center p-3" placeholder="Email" id="email" name="email">

                        <!-- Display error message for email -->
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Input field for the password -->
                    <div class="input-group form-group mt-3">
                        <input type="password" class="form-control text-center p-3" placeholder="Password" id="password" name="password">

                        <!-- Display error message for password -->
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Dropdown select for the user type (either Searcher or Servicer) -->
                    <div class="input-group form-group mt-3">
                        <select id="user_type" name="user_type" class="form-select">
                            <option value="">Select User Type</option>
                            <option value="1">Searcher</option> <!-- Option for Searcher -->
                            <option value="2">Servicer</option> <!-- Option for Servicer -->
                        </select>

                        <!-- Display error message for user type -->
                        @if ($errors->has('user_type'))
                            <span class="text-danger">{{ $errors->first('user_type') }}</span>
                        @endif
                    </div>

                    <!-- Checkbox to accept terms and conditions -->
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">I accept the terms and conditions</label>

                        <!-- Display error message if terms are not accepted -->
                        @if ($errors->has('terms'))
                            <span class="text-danger">{{ $errors->first('terms') }}</span>
                        @endif
                    </div>

                    <!-- Submit button to register the user -->
                    <div class="text-center">
                        <input type="submit" value="Register" class="btn btn-primary mt-3 w-100 p-2" name="register-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
