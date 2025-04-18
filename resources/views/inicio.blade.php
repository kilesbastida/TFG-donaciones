<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h1>Bienvenido a mi Aplicación Laravel</h1>
        <p>Esta es la página de inicio</p>

        @guest
            <a href="{{ route('login') }}">Iniciar Sesión</a> |
            <a href="{{ route('register') }}">Registrarse</a>
        @else
            <p>Hola, {{ Auth::user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        @endguest
    </div>
</body>
</html>
