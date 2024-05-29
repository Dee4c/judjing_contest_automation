<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Judge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Judge</div>
    
                    <div class="card-body">
                        <form id="addJudgeForm" method="POST" action="{{ route('addJudge') }}">
                            @csrf
                            @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
    
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
    
                                    <div id="usernameError" class="invalid-feedback"></div>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
    
                                    <div id="passwordError" class="invalid-feedback"></div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Add Judge</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>