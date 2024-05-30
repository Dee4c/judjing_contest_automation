<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Judge Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Add custom styles here */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #dee2e6;
            padding-top: 60px;
            z-index: 1; /* Ensure the sidebar is above the content */
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            padding: 10px 0;
            position: fixed; /* Fix the navbar at the top */
            width: 100%; /* Ensure the navbar spans the full width */
            z-index: 2; /* Ensure the navbar is above the sidebar */
            background-color: #fff; /* Ensure the navbar is visible */
        }

        .add-candidate-btn {
            margin-top: 80px;
            margin-bottom: 20px;
            margin-left: 1500px;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"> <!-- Center the content -->
            <span class="navbar-brand mb-0 h1">Judge Dashboard</span>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="GET">
                        <button type="submit" class="btn btn-danger nav-link">Logout</button>
                    </form>                    
                </li>
            </ul>
        </div>
    </nav>

    <div class="sidebar">
        <ul class="nav flex-column">
            <!-- Add sidebar links here -->
            <!-- Example link -->
            <li class="nav-item">
                {{-- <a class="nav-link" href="{{route('usermanage.dashboard')}}">User Management</a>
                <a class="nav-link" href="{{ route('candidate.dashboard') }}">Candidate Management</a>
                <a class="nav-link" href="#">Reports</a> --}}
            </li>
        </ul>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>