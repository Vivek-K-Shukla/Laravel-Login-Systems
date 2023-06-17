<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 p-2 bordered" style="margin:20px 0px 0px 350px; border:1px solid black;">
                <h4>Reset Password</h4><hr>
                @if(Session::has('msg'))
                <div class="alert alert-success">{{Session::get('msg')}}</div>
                @endif
                <form action="{{url('update-password')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Old Password:</label>
                        <input type="text" name="password" class="form-control" placeholder="Enter Current Password" value="{{old('name')}}">
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="newpassword">Enter New Password:</label>
                        <input type="password" name="newpassword" class="form-control" placeholder="Enter password" value="{{old('newpassword')}}">
                        <span class="text-danger">@error('newpassword'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="cannewpassword">Confirm New Password:</label>
                        <input type="text" name="cannewpassword" class="form-control" placeholder="Confirm password" value="{{old('cannewpassword')}}">
                        <span class="text-danger">@error('cannewpassword'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group mt-3">
                        <button class="btn btn-primary" type="submit">Update Password</button>
                    </div>
                </form>
</div>
</div>
</div>
</body>
</html>