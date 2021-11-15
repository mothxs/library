<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="icon" href="/img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="card">
        <h2 class="card-title">LOGIN</h2>
        <form class="form" method="POST" action="/login">
            @csrf
            @error('email')
                <p class="credentials-error">{{ $message }}</p>
            @enderror
            <div class="section">
                <label for="email">Email</label>
                <input id="email" name="email" class="input" type="text" required autocomplete="on">
            </div>
            <div class="underline"></div>
            <div class="section">
                <label for="password">Contraseña</label>
                <input id="password" name="password" class="input" type="password" required>
            </div>
            <div class="underline"></div>
            <div class="section inline">
                <label for="remember">Recordarme</label>
                <input id="remember" name="remember" class="checkbox" type="checkbox">
            </div>
            <div class="section">
                <button class="button" type="submit">Entrar</button>
            </div>
        </form>
    </div>
</body>
</html>