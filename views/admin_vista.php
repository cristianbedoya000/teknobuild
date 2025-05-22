<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    echo "<script>alert('Acceso denegado. Solo administradores pueden ingresar.'); window.location.href='../views/Inicio.php';</script>";
    exit();
}

$productoEditar = isset($_SESSION['productoEditar']) ? $_SESSION['productoEditar'] : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>TEKNOBUILD-ADMN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../Style/listar.css">
    <link rel="stylesheet" href="../Style/inicio.css">
    
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container_listar" id="Listar">

        <h2 class="form-title">INVENTARIO</h1>
    
        <input type="text" id="buscar" placeholder="Buscar producto..." onkeyup="buscarProducto()">
        <i class="fa-solid fa-magnifying-glass"></i>
        <div id="tabla_productos">
            <?php include 'panel.php'; ?>
        </div>
        <div>
            <p> Deseas Registrar</p>
            <button id="RegistrarItem" class="i_s_button">Registrar</button>
        </div> 
    </div>

    <div class="container" id="Register" style="display: none;">
        <h2 class="form-title">REGISTRAR PRODUCTO</h1>
        <form action="panel.php" method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <i class="fa-solid fa-signature"></i>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre Del Producto" required><br>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-cloud"></i>
            <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" required><br>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-money-bill-1-wave"></i>
            <input type="text" name="precio" id="precio" placeholder="Precio" required><br>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-hashtag"></i>
            <input type="text" name="stock" id="stock" placeholder="Cantidad" required><br>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-images"></i>
            <input type="file" id="imagen" name="imagen" required>
        </div>
        <div class="input-group">
            <i class="fa-solid fa-money-bill-1-wave"></i>
            <input type="text" name="categoria" id="categoria" placeholder="Categoria" required><br>
        </div>
        <button type="submit" class="btn" name="Register" value="Registrarse">Registrar Item</button>
        </form>
        <div>
            <p> Volver al panel administrativo</p>
            <button id="inicioButton" class="btn">Inventario</button>
        </div>
        
    </div>

    <script src="../js/script-admin_view.js"></script>
</body>
</html>
