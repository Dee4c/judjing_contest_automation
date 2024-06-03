<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Google Font Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 59%, rgba(198, 174, 53, 1) 99%);
            width: 250px;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }

        .sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
            padding-right: 50px; /* Increase right padding to accommodate the icon */
        }

        .sidebar .logo-details .icon {
            position: absolute;
            top: 50%;
            right: -25px; /* Position the icon outside the box */
            transform: translateY(-50%);
            font-size: 22px;
            color: #fff;
            transition: all 0.5s ease;
        }

        .sidebar .logo-details .icon {
            right: 0; /* Move the icon inside the box when sidebar is open */
        }

        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-left: 40px;
            opacity: 1;
            transition: all 0.5s ease;
        }

        .sidebar .logo-details #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 22px;
            transition: all 0.4s ease;
            font-size: 23px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .sidebar .logo-details #btn {
            text-align: right;
        }

        .sidebar i {
            color: #fff;
            height: 60px;
            min-width: 50px;
            font-size: 28px;
            text-align: center;
            line-height: 60px;
        }

        .sidebar .nav-list {
            margin-top: 20px;
            height: 100%;
        }

        .sidebar li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }

        .sidebar li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 3;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
        }

        .sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            top: 50%;
            transform: translateY(-50%);
        }

        .sidebar li.open .tooltip {
            display: none;
        }

        .sidebar input {
            font-size: 15px;
            color: #fff;
            font-weight: 400;
            outline: none;
            height: 50px;
            width: 100%;
            width: 50px;
            border: none;
            border-radius: 12px;
            transition: all 0.5s ease;
            background: #1d1b31;
        }

        .sidebar li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: #11101D;
        }

        .sidebar li a:hover {
            background: #FFF;
        }

        .sidebar li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 1;
            pointer-events: auto;
            transition: 0.4s;
        }

        .sidebar li a:hover .links_name,
        .sidebar li a:hover i {
            transition: all 0.5s ease;
            color: #11101D;
        }

        .sidebar li i {
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            border-radius: 12px;
        }

        .sidebar li.profile {
            position: fixed;
            height: 60px;
            width: 78px;
            left: 0;
            bottom: -8px;
            padding: 10px 14px;
            background: #1d1b31;
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .sidebar li.profile .profile-details {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }

        .sidebar li img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
        }

        .sidebar li.profile .name,
        .sidebar li.profile .job {
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            white-space: nowrap;
        }

        .sidebar li.profile .job {
            font-size: 12px;
        }

        .sidebar .profile #log_out {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: #1d1b31;
            width: 100%;
            height: 60px;
            line-height: 60px;
            border-radius: 0px;
            transition: all 0.5s ease;
        }

        .home-section {
            position: relative;
            background: #E4E9F7;
            min-height: 100vh;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            transition: all 0.5s ease;
            z-index: 2;
        }

        .home-section .text {
            display: inline-block;
            color: #11101d;
            font-size: 25px;
            font-weight: 500;
            margin: 18px
        }

        @media (max-width: 420px) {
            .sidebar li .tooltip {
                display: none;
            }
        }

        /* Add custom styles here */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .add-judge-btn {
            float: right;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
            text-align: center;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .candidate-image {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Miss Q</div>
    </div>
    <ul class="nav-list">
        <li>
            <a href="{{route('usermanage.dashboard')}}">
                <i class='bx bx-user'></i>
                <span class="links_name">User Management</span>
            </a>
            <span class="tooltip">User Management</span>
        </li>
        <li>
            <a href="{{ route('usermanage.candidate_dash')}}">
                <i class='bx bxs-user-check'></i>
                <span class="links_name">Candidates</span>
            </a>
            <span class="tooltip">Candidate Management</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-edit'></i>
                <span class="links_name">Preliminaries</span>
            </a>
            <span class="tooltip">Preliminaries</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-line-chart'></i>
                <span class="links_name">Semi-Finals</span>
            </a>
            <span class="tooltip">Semi-Finals</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-crown'></i>
                <span class="links_name">Finals</span>
            </a>
            <span class="tooltip">Finals</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="profile.jpg" alt="profileImg">
                <div class="name_job">
                    <div class="name">Admin</div>
                </div>
            </div>
            <a href="{{ route('logout') }}" class="logout-link">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
<div class="content">
    <div class="container">
       <!-- Add Candidate Button -->
<div class="add-judge-btn">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCandidateModal">Add Candidate</button>
</div>

<!-- Candidates Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Candidate Number</th>
            <th>Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Waist</th>
            <th>Hips</th>
            <th>Chest</th>
            <th>Action</th> <!-- Assuming you want to keep the action column -->
        </tr>
    </thead>
    <tbody>
        <!-- Replace the code below with your user data retrieval and display logic -->
        <!-- Example loop for displaying candidate data -->
        @foreach($candidates as $candidate)
        <tr>
            <td><a href="#" class="candidate-image-link" data-bs-toggle="modal" data-bs-target="#imageModal"><img src="{{ asset($candidate->candidateImage) }}" alt="Candidate Image" class="candidate-image"></a></td>
            <td>{{ $candidate->candidateNumber }}</td>
            <td>{{ $candidate->candidateName }}</td>
            <td>{{ $candidate->age }}</td>
            <td>{{ $candidate->candidateAddress }}</td>
            <td>{{ $candidate->waist }}</td>
            <td>{{ $candidate->hips }}</td>
            <td>{{ $candidate->chest }}</td>
            <td>
                {{-- Edit Button --}}
                {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCandidateModal{{ $candidate->id }}">Edit</a> --}}
                
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $candidate->id }}">Delete</button>
            </td>
        </tr>
        <!-- Delete Account Modal for this Candidate -->
        <div class="modal fade" id="deleteModal{{ $candidate->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete the candidate {{ $candidate->candidateName }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('candidate.delete', $candidate->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>


<!-- Add Candidate Modal -->
<div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCandidateModalLabel">Add Candidate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="candidateFormsContainer">
                <!-- Candidate Form -->
            <form id="addCandidateForm" method="POST" action="{{ route('candidate.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Candidate Number -->
                <div class="form-group">
                    <label for="candidateNumber">Candidate Number</label>
                    <input type="text" class="form-control" name="candidateNumber" required>
                </div>
                <!-- Name -->
                <div class="form-group">
                    <label for="candidateName">Name</label>
                    <input type="text" class="form-control" name="candidateName" required>
                </div>
                <!-- Age -->
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control" name="age" required>
                </div>
                <!-- Address -->
                <div class="form-group">
                    <label for="candidateAddress">Address</label>
                    <input type="text" class="form-control" name="candidateAddress" required>
                </div>
                <!-- Waist -->
                <div class="form-group">
                    <label for="waist">Waist</label>
                    <input type="number" class="form-control" name="waist" required>
                </div>
                <!-- Hips -->
                <div class="form-group">
                    <label for="hips">Hips</label>
                    <input type="number" class="form-control" name="hips" required>
                </div>
                <!-- Chest -->
                <div class="form-group">
                    <label for="chest">Chest</label>
                    <input type="number" class="form-control" name="chest" required>
                </div>
                <!-- Image Upload -->
                <div class="form-group">
                    <label for="candidateImage">Upload Image</label>
                    <input type="file" class="form-control" name="candidateImage" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Candidate</button>
            </div>
            </form>
        </div>
    </div>
</div>


         <!-- Image Modal -->
         <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Candidate Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" alt="Candidate Image" id="modalImage" style="max-width: 100%; max-height: 80vh;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.querySelectorAll('.candidate-image-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const imageSrc = this.querySelector('img').getAttribute('src');
            const modalImage = document.getElementById('modalImage');
            modalImage.setAttribute('src', imageSrc);
        });
    });
</script>
</body>
</html>
