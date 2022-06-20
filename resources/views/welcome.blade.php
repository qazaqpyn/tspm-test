<!DOCTYPE html>
<html>
    <head>
        <title>TSPM</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <h1 class="text-center">TSPM</h1>
        <div class="row">
        <div class="col-lg-12 margin-tb">
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('users.index') }}"> Users</a>
            <a class="btn btn-secondary btn-lg btn-block" href="{{ route('positions.index') }}"> Positions</a>
        </div>
    </div>
    </body>
</html>