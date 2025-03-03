<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #ecf0f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-container {
            background: #ecf0f3;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 8px 8px 16px #b8bcc2, -8px -8px 16px #ffffff;
            width: 350px;
            text-align: center;
        }

        .input-field {
            background: #ecf0f3;
            border: none;
            border-radius: 50px;
            padding: 15px;
            box-shadow: inset 8px 8px 16px #b8bcc2, inset -8px -8px 16px #ffffff;
            width: 100%;
            margin-bottom: 20px;
            outline: none;
        }

        .btn-custom {
            background: #ecf0f3;
            border: none;
            border-radius: 50px;
            padding: 15px;
            box-shadow: 8px 8px 16px #b8bcc2, -8px -8px 16px #ffffff;
            width: 100%;
            font-weight: bold;
        }

        .btn-custom:hover {
            box-shadow: inset 4px 4px 8px #b8bcc2, inset -4px -4px 8px #ffffff;
        }

        /* Error message styling */
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            float: left;       }

        .text-danger {
            color: #dc3545;
            font-size: 0.875rem;
        }

        /* Anchor tag styling */
        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        a:focus {
            outline: none;
            box-shadow: 0 0 0 2px #0056b3;
        }

        /* Extra Styling for Error Messages */
        .text-danger {
            font-size: 14px;
            font-weight: bold;
            color: #e74c3c;
        }

        .alert-danger ul {
            list-style-type: none;
            padding-left: 0;
        }

        .alert-danger li {
            margin-bottom: 5px;
        }
        
    </style>
</head>

<body>

    <div class="signup-container">
        <h2 class="mb-4">Sign Up</h2>

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

        <form action="{{ route('Admin_store') }}" method="POST">
            @csrf
            @method('POST')
            
            <input type="text" class="input-field" name="name" placeholder="Full Name" value="{{ old('name') }}" autocomplete="off">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="email" class="input-field" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" class="input-field" name="password" placeholder="Password" autocomplete="off">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" class="input-field" name="password_confirmation" placeholder="Confirm Password" autocomplete="off">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-custom">SIGN UP</button>
        </form>

        <p class="mt-3">Already have an account? <a href="{{ route('Admil_login') }}">Sign In</a></p>
    </div>

</body>

</html>
