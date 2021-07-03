<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HelloToVet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>
<body>

<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">AGE</th>
        <th scope="col">Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vets as $vet)
    <tr>
        <th scope="row">1</th>
        <td>{{$vet->name}}</td>
        <td>{{$vet->age}}</td>
        <td>{{$vet->phone}}</td>
        <td><a href="dropvet/{{$vet->id}}" class="btn btn-dark">Drop</a></td>
        <td><a href="editvet/{{$vet->id}}" class="btn btn-dark">Update</a></td>
    </tr>
    @endforeach
    </tbody>
</table>

 <form method="post" action ="{{ route('adddata') }}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="namevet">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">age</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter age" name="agevet">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">phone</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter phone" name="phonevet">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


</body>
</html>
