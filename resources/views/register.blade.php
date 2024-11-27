<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-container h2 {
            font-weight: 600;
            color: #333;
        }

        .form-container .form-label {
            font-size: 0.9rem;
            color: #555;
        }

        .form-container .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            box-shadow: none;
            transition: border-color 0.3s ease;
        }

        .form-container .form-control:focus {
            border-color: #80bdff;
            box-shadow: none;
        }

        .form-container .btn {
            border-radius: 5px;
            padding: 12px;
            font-size: 1rem;
        }

        .form-container .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .form-container .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <h2 class="text-center mb-4">Register New Account</h2>
            <form action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input name="name" type="text" class="form-control w-100" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control w-100" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control w-100" required>
                </div>
                <button type="submit" class="btn btn-success w-100 mt-3">Register</button>
                <a href="/" class="btn btn-secondary w-100 mt-3">Log In</a>
            </form>
        </div>
    </div>
</body>

</html>
