@extends("layouts.default") <!-- Extends the default layout for the page -->

@section("title", "Login") <!-- Sets the title for the page -->

@section("content")
    <!-- Main container for the login page with flexbox for centering -->
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center" id="template-bg-3">

        <!-- Success message after successful login or registration -->
        @if(session()->has("success"))
            <div class="alert alert-success">
                {{ session()->get("success") }}
            </div>
        @endif

        <!-- Card for the login form -->
        <div class="card text-dark bg-light mb-5 p-5 bg-light bg-gradient col-md-4" style="border-radius: 15px">
            <div class="card-header text-center" style="background-color: #f8f9fa;"> <!-- Card header background color matching card -->
                <h3>Login</h3> <!-- Title of the login form -->
            </div>
            <div class="card-body mt-3">
                <!-- Login form with POST method to send data to the 'login.post' route -->
                <form name="login" action="{{ route('login.post') }}" method="POST">
                    @csrf <!-- CSRF protection token for security -->

                    <!-- Input field for email -->
                    <div class="input-group form-group mt-3">
                        <input type="text" class="form-control text-center p-3" placeholder="Email" id="email" name="email" required autofocus>

                        <!-- Display error message if there are validation issues with the email field -->
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Input field for password -->
                    <div class="input-group form-group mt-3">
                        <input type="password" class="form-control text-center p-3" placeholder="Password" id="password" name="password" required>

                        <!-- Display error message if there are validation issues with the password field -->
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Remember Me checkbox -->
                    <div class="form-group mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <!-- Submit button for login -->
                    <div class="text-center">
                        <input type="submit" value="Login" class="btn btn-primary mt-3 w-100 p-2" name="login-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
