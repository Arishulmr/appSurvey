<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body, html { height: 100%; margin: 0; }
        .login-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            padding: 2rem;
            background-color: #007BFF;
            border-radius: 20px;
        }
    </style>
</head>
<body class="bg-white">
    <div class="login-container">
        <div class="form-container text-white">
            <h2 class="text-center mb-4">WELCOME ADMINISTRATOR!</h2>

            <!-- Check for error message and show alert -->
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input name="loginName" type="text" class="form-control w-100" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="loginPassword" type="password" class="form-control w-100" required>
                </div>
                <button type="submit" class="btn btn-success w-100 mt-3">Login</button>
            </form>
            <a href="/register" class="btn btn-secondary w-100 mt-3">Register</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12jZ4u+tP7elx39eWMLc3pDPEynfIl0r6EXz0FqCWp" crossorigin="anonymous"></script>
</body>
</html>
