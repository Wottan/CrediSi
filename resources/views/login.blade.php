<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="form-container">
            @csrf
            <label>
                Email: <input type="email" name="email">
            </label>
            <label>
                Password: <input type="password" name="password">
            </label>
        </div>
        <button type="submit">
            Iniciar sesión
        </button>
    </form>
</body>
</html>
