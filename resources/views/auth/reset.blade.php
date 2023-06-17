<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">

</div>
    <div class="col-md-4 col-md-offset-4 mt-4 p-3">
    <h4><strong>Reset Password</strong></h4>
    @if(Session::has('message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert" id="message">
        {{Session::get('message')}}
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <form action="{{url('reset-password-submit')}}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="email">Enter Registered Email Id:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{old('email')}}">
            <span class="text-danger">@error('email'){{$message}}@enderror</span>
    </div>
    <div class="mt-3">
    <button type="submit" class="btn btn-primary btnwidth">Submit</button>
    </div>
</div>
</form>
</div>
</div>
</div>
</body>
</html>