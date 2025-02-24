 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS for Anchor Link */
        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            color: #2ecc71;
            transform: scale(1.1);
        }

        a:focus {
            outline: none;
        }

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

        /* Styling for error messages */
        .text-danger {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            font-weight: bold;
            text-align: left;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-danger ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .alert-danger li {
            margin-bottom: 5px;
        }
    </style>