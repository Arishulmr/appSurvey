<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 200px;
            right: 0;
            height: 60px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Keeps navbar above other content */
    }
        body, html {
            height: 100%;
            margin: 0;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: rgb(108, 143, 233);
            padding: 20px;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar h3 {
            margin-bottom: 2rem;
            color: white;
            font-size: 0.75rem;
        }

        .sidebar h5 {
            color: lightgray;
            font-size: 0.85rem;
        }

        .sidebar .nav-link {
            padding: 10px;
            margin-bottom: 5px;
            color: #c4d4f5;
            border-radius: 5px;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background-color: #567fac;
            color: rgb(255, 255, 255);
        }

        .content {
            margin-left: 200px; /* Matches the sidebar width */
            padding-top: 80px; /* Space for the fixed topbar */
            padding-right: 20px;
            padding-left: 20px;
        }

        .divider {
            border-top: 1px solid rgb(197, 197, 197);
            margin: 10px 0;
        }

        .icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .navbar-custom {
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="text-center">ADMINISTRATOR</h3>
            <div class="divider"></div>
            <h5 class="categories">Pages</h5>
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a href="{{ route('people.index') }}" class="nav-link">
                        <img src="https://img.icons8.com/material-outlined/24/ffffff/user-male.png" alt="People" class="icon" /> People
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('request.index') }}" class="nav-link">
                        <img src="https://img.icons8.com/material-outlined/24/ffffff/task.png" alt="Requests" class="icon" /> Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('questionnaires.index') }}" class="nav-link">
                        <img src="https://img.icons8.com/material-outlined/24/ffffff/survey.png" alt="Questionnaire" class="icon" /> Questionnaire
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('survey.index') }}" class="nav-link">
                        <img src="https://img.icons8.com/material-outlined/24/ffffff/list.png" alt="Survey" class="icon" /> Survey
                    </a>
                </li>
            </ul>

            <div class="divider"></div>

            <h5 class="categories">Settings</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <img src="https://img.icons8.com/material-outlined/24/ffffff/tags.png" alt="Category" class="icon" /> Category
                    </a>
                </li>
                </ul>

            <div class="divider"></div>

        </div>

        <!-- Content Area with Navbar -->
        <div class="content w-100">
            <div class="navbar-custom">
                <div class="dropdown">
                    <img src="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg" alt="Profile Picture" class="profile-pic" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="username">{{ Auth::user()->name }}</span>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <form action="/logout" method="POST" class="dropdown-item">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 text-dark">Log out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content Area -->
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
