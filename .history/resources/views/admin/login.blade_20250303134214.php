<!DOCTYPE html>
<html lang="en">

<head>
   @include ('admin.admin_login_heeder')
</head>

<body>

    <div class="login-container">
        <h2 class="mb-4">Admin Login</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Display Session Error Message -->
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Display Session Success Message -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('Admil_login') }}" method="POST">
            @csrf
            @method('post')
            <input type="email" class="input-field" name="email" placeholder="Email" autocomplete="off">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" class="input-field" name="password" placeholder="Password" autocomplete="off">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-custom">SIGN IN</button>
        </form>

        <p class="mt-3">Forgot password? <a href="{{ route('forgetPasswordShow') }}">Reset</a></p>

        <!-- Switch to Sign Up -->
        <p class="mt-3">Don't have an account? <a href="{{ route('admin.register') }}">Sign Up</a></p>
    </div>

</body>

</html>
