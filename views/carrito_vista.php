<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>TEKNOBUILD</title>
    <link rel="stylesheet" href="../Style/inicio.css"> 
    <link rel="stylesheet" href="../Style/carrito.css"> 
</head>
<body>
    <?php include'../includes/navbar.php'; ?>

    <h2 class="carrito-title">Tu Carrito</h2>

    <?php if(isset($_SESSION['mensaje_carrito'])): ?>
        <p><?= $_SESSION['mensaje_carrito']; ?></p>
        <?php unset($_SESSION['mensaje_carrito']); ?>
    <?php endif; ?>

    <?php if(!empty($_SESSION['carrito'])):?>
        <table class="carrito-tabla">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>

            <?php foreach($_SESSION['carrito'] as $producto):?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre'] ?? 'Sin nombre') ?></td>
                    <td>$<?= number_format(floatval($producto['precio']), 2) ?></td>
                    <td><?= $producto['cantidad'] ?></td>
                    <td>$<?= number_format(floatval($producto['precio_total']), 2) ?></td>
                    <td>
                        <form action="../controllers/carrito.php" method="POST" class="form-eliminar">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <button type="submit" name="eliminar" class="btn-eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>            
        </table>
        <br>
        <a href="checkout.php" class="btn-pago">Proceder al pago</a>
    <?php else: ?>
        <p class="carrito-vacio">Tu carrito está vacio</p>
    <?php endif; ?>
    
</body>
</html>