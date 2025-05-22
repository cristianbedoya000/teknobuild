<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../Style/form.css">
</head>
<body>

    <div class="container" id="Register" style="display: none;" >
        <h1 class="form-title">Registrar Usuario</h1>
        <form method="POST" action="../controllers/register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="usuario" id="username" placeholder="Nombre De Usuario" required><br>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Correo Electrónico" required><br>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Contraseña" required><br>
            </div>
            <button type="submit" class="btn" name="Register" value="Registrarse">Registrarse</button>
        </form>

        <p class="or">
            ------- or -------
        </p>

        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
            <p>Ya tienes cuenta?</p>
            <button id="IniciarSesionButton" class="i_s_button">Iniciar Sesion</button>
        </div>

    </div>

    <div class="container" id="Login" >
        <h1 class="form-title">Iniciar Sesion</h1>
        <form method="POST" action="../controllers/register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="correo" id="correo" placeholder="Correo Electrónico" required><br>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="contraseña" id="constraseña" placeholder="Contraseña" required><br>
            </div>
            <button type="submit" class="btn" name="Login" value="IniciarSesion">Iniciar Sesion</button>
        </form>
        <a href="" class="recovery">Recuperar Contraseña</a>
        <p class="or">
            ------- or -------
        </p>

        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
            <p>Deseas Crear tu cuenta ?</p>
            <button id="RegistrarseButton" class="i_s_button">Registrarse</button>
        </div>
    </div>

    <script src="../js/script-l_r.js"></script>
</body>
</html>