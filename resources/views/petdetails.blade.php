<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>

<body>

<form method="POST" action="{{ url('updatepet',[ $pet->id ]) }}">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $pet->name }}" placeholder="Enter name" name="namepet">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">color</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter color" value="{{ $pet->color }}" name="colorpet">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>
