<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #ecf0f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
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
    </style>
</head>
<body>

    <div class="login-container">
        <h2 class="mb-4">Admin Login</h2>

        <!-- Display Session Messages -->
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <input type="email" class="input-field" name="email" placeholder="Email" required>
            <input type="password" class="input-field" name="password" placeholder="Password" required>
            <button type="submit" class="btn btn-custom">SIGN IN</button>
        </form>

        <p class="mt-3">Forgot password? <a href="#">Reset</a></p>
    </div>

</body>
</html>
