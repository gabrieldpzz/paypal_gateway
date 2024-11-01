<!-- resources/views/auth.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión y Registro - Mi Aplicación</title>
    <link rel="stylesheet" href="{{ asset('css/spotify-style.css') }}">
</head>
<body>
<div class="container">
    <!-- Mostrar mensaje de error si existe -->
    @if ($errors->any())
    <div class="error-message">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- Formulario de Login -->
    <div class="login-container form-container">
        <h2>Iniciar sesión</h2>
        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="input-box" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="input-box" required>
            </div>
            <button type="submit" class="login-button">Iniciar sesión</button>
        </form>
        <div class="forgot-password">
            <a href="#" id="forgotLabel">¿Olvidaste tu contraseña?</a>
        </div>
        <div class="signup-link">
            <p>¿No tienes una cuenta? <a href="#" id="signupLabel">Regístrate</a></p>
        </div>
    </div>

    <!-- Formulario de Registro -->
    <div class="registration-container form-container" style="display: none;">
        <h2>Registro</h2>
        <form action="{{ route('register.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre completo</label>
                <input type="text" id="name" name="name" class="input-box" required>
            </div>
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" class="input-box" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="input-box" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="input-box" required>
            </div>
            <button type="submit" class="login-button">Registrarse</button>
        </form>
        <div class="signup-link">
            <p>¿Ya tienes una cuenta? <a href="#" id="loginLabel2">Iniciar sesión</a></p>
        </div>
    </div>

    <!-- Formulario de Recuperación de Contraseña -->
    <div class="forgot-password-container form-container" style="display: none;">
        <h2>Recuperar Contraseña</h2>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="forgotEmail">Correo electrónico</label>
                <input type="email" id="forgotEmail" name="email" class="input-box" required>
            </div>
            <button type="submit" class="login-button">Enviar</button>
        </form>
        <div class="signup-link">
            <p>¿Ya tienes una cuenta? <a href="#" id="loginLabel">Iniciar sesión</a></p>
        </div>
    </div>
</div>

<script>
    // Funciones para alternar entre formularios
    document.getElementById("signupLabel").addEventListener("click", function() {
        document.querySelector(".login-container").style.display = "none";
        document.querySelector(".registration-container").style.display = "block";
        document.querySelector(".forgot-password-container").style.display = "none";
    });

    document.getElementById("loginLabel2").addEventListener("click", function() {
        document.querySelector(".login-container").style.display = "block";
        document.querySelector(".registration-container").style.display = "none";
        document.querySelector(".forgot-password-container").style.display = "none";
    });

    document.getElementById("forgotLabel").addEventListener("click", function() {
        document.querySelector(".login-container").style.display = "none";
        document.querySelector(".registration-container").style.display = "none";
        document.querySelector(".forgot-password-container").style.display = "block";
    });

    document.getElementById("loginLabel").addEventListener("click", function() {
        document.querySelector(".login-container").style.display = "block";
        document.querySelector(".registration-container").style.display = "none";
        document.querySelector(".forgot-password-container").style.display = "none";
    });
</script>
</body>
</html>
