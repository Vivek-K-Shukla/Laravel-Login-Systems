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
            <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
                <h4>Login</h4><hr>
                <form action="login-user" method="POST">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email"  value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password"  value="{{old('password')}}" class="form-control" placeholder="Enter password"><br>
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Login</button>
                    </div><br>
                    <a href="register">New User!! Register Here</a>
                </form>
</div>
</div>
</div>
</body>
</html>