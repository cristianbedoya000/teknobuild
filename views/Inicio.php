<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../includes/conexion.php");

function puedeAgregarAlCarrito() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'usuario';
}

$query = "SELECT * FROM productos";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta SQL: " . $conexion->error);
}

// Agrupar los productos por categoría
$categorias = [];

while ($fila = $resultado->fetch_assoc()) {
    $categorias[$fila['categoria']][] = $fila;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Store</title>
    <link rel="stylesheet" href="../Style/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>    
<?php include'../includes/navbar.php'; ?>


<video autoplay muted loop id="video-items">
    <source src="../Assets/fondo-item.mp4" type="video/mp4">
</video>

<main class="contenedor_scroll_wrapped">

    <?php foreach ($categorias as $categoria => $productos): ?>
        <section class="categoria-section" id="<?= strtolower(str_replace(' ', '_', $categoria)) ?>">
            <h2><?= strtoupper($categoria) ?></h2>
            <div class="contenedor_scroll">

                <?php foreach ($productos as $fila): ?>
                    <div class="producto-card">
                        <img src="<?= str_replace('../','/Store/',htmlspecialchars($fila['imagen'])) ?>" width="120" alt="<?= htmlspecialchars($fila['nombre']) ?>">
                        <div class="producto-info">
                            <h3 class="nombre"><?= $fila['nombre'] ?></h3>
                            <p class="precio">$<?= number_format($fila['precio'], 2) ?></p>
                            <p class="stock">Stock disponible: <?= $fila['stock'] ?></p>

                            <?php if (puedeAgregarAlCarrito()): ?>
                                <form method="POST" action="../controllers/carrito.php">
                                    <input type="hidden" name="producto_id" value="<?= $fila['id'] ?>">
                                    <input type="hidden" name="nombre" value="<?= htmlspecialchars($fila['nombre']) ?>">
                                    <input type="hidden" name="precio" value="<?= $fila['precio'] ?>">
                                    <button type="submit" name="agregar" class="btn-agregar">Añadir al carrito</button>
                                </form>
                            <?php else: ?>
                                <p class="mensaje-error">Solo los ingresadores pueden añadir productos.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </section>
    <?php endforeach; ?>

</main>

<script src="../js/script-categorias.js"></script>

</body>
</html>