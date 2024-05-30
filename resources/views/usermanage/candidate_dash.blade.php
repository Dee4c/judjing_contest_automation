<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidate Management</title>
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
            <span class="navbar-brand mb-0 h1">Candidate Dashboard</span>
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

      <!-- Add Candidate Button -->
      <button type="button" class="btn btn-primary add-candidate-btn" data-bs-toggle="modal" data-bs-target="#addCandidateModal">
        Add Candidate
    </button>

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
        </tbody>
    </table>
    
    <div class="sidebar">
        <ul class="nav flex-column">
            <!-- Add sidebar links here -->
            <!-- Example link -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('usermanage.dashboard')}}">User Management</a>
                <a class="nav-link" href="{{ route('candidate.dashboard') }}">Candidate Management</a>
                <a class="nav-link" href="#">Reports</a>
            </li>
        </ul>
    </div>

    <!-- Add Candidate Modal -->
    <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCandidateModalLabel">Add Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCandidateForm" method="POST" action="{{ route('candidate.add') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="candidateNumber" class="form-label">Candidate Number</label>
                            <input type="text" class="form-control" id="candidateNumber" name="candidateNumber">
                        </div>
                        <div class="mb-3">
                            <label for="candidateName" class="form-label">Candidate Name</label>
                            <input type="text" class="form-control" id="candidateName" name="candidateName">
                        </div>
                        <div class="mb-3">
                            <label for="candidateAge" class="form-label">Candidate Age</label>
                            <input type="number" class="form-control" id="candidateAge" name="candidateAge">
                        </div>
                        <div class="mb-3">
                            <label for="candidateAddress" class="form-label">Candidate Address</label>
                            <textarea class="form-control" id="candidateAddress" name="candidateAddress" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="candidateStatistics" class="form-label">Candidate Statistics</label>
                            <textarea class="form-control" id="candidateStatistics" name="candidateStatistics" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
