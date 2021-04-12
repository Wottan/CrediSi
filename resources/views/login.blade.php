<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <style>
        .form-container {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 1em;
        }
    </style>
    <h1>Sistema Persona</h1>
    <form action="{{route('login-post')}}" method="POST">

        @if($errors->has("email"))
            <p>{{$errors->first("email")}}</p>
        @endif

        <div class="form-container">
            @csrf
            <label>
                Email: <input type="email" name="email">
            </label>
            <label>
                Password: <input type="password" name="password">
            </label>
        </div>
        <a href="{{route("socialite-login")}}">
            Iniciar sesion con Google
        </a>
        <button type="submit">
            Iniciar sesión
        </button>
    </form>
</body>
</html>
