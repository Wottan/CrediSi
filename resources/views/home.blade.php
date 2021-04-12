<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php($userName =  Auth::user()->name ?? session("user-socialite.name"))
    <h1>Bienvenido {{$userName}}</h1>
    <form action="{{route("logout")}}" method="POST">
        @csrf
        <button>Cerrar sesion</button>
    </form>
</body>
</html>
