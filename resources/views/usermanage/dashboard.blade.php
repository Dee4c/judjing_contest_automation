<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
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
        
        /* Add border to table */
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

        /* Add style for the Add Judge button */
        .add-judge-btn {
            float: right;
            margin-top: 50px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid"> <!-- Center the content -->
            <span class="navbar-brand mb-0 h1">Welcome to Admin Dashboard</span>
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
                <a class="nav-link" href="{{route('usermanage.dashboard')}}">User Management</a>
                <a class="nav-link" href="{{route('candidate.dashboard')}}">Candidate Management</a>
                <a class="nav-link" href="#">Reports</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="container">
            <!-- Add Judge Button -->
            <div class="add-judge-btn">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJudgeModal">Add Judge</button>
            </div>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Name</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->password }}</td> 
                        <td>{{ $user->name }}</td> 
                        <td>
                            <!-- Edit button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                Edit
                            </button>

                            <!-- Edit Account Modal -->
                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit form -->
                                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="edit_username">Username</label>
                                                    <input type="text" class="form-control" id="edit_username" name="edit_username" value="{{ $user->username }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_password">Password</label>
                                                    <input type="password" class="form-control" id="edit_password" name="edit_password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit_name">Name</label>
                                                    <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $user->name }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete button -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                Delete
                            </button>
                    
                            <!-- Delete Account Modal -->
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the account for {{ $user->username }}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add Judge Modal -->
    <div class="modal fade" id="addJudgeModal" tabindex="-1" aria-labelledby="addJudgeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJudgeModalLabel">Add Judge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="judgeFormsContainer">
                    <!-- Initial Judge Form -->
                    <form id="addJudgeForm" method="POST" action="{{ route('addJudge') }}">
                        @csrf
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" required autocomplete="username" autofocus>
                            <div id="usernameError" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required autocomplete="new-password">
                            <div id="passwordError" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required autocomplete="new-name">
                            <div id="nameError" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Judge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
