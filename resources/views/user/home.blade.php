<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-12">
                <h4 style="font-family:sans-serif; font-weight:bold; text-align:center;">Welcome To Home</h4>
                <a href="/logout"class="btn btn-warning" style="margin-left:1000px;">Logout</a>
               <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Asigned Task</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                    <td>{{$member->name}}</td>
                    <td>{{$member['email']}}</td>
                    <td>{{$member['status']}}</td>
                    <td>{{$member['task']}}</td>
                </tr>
                @endforeach
</thbody>
</div>
</div>
</div>
</body>
</html>