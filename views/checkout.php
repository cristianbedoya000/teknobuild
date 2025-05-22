<?php 
session_start();
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<script>alert('Tu carrito está vacío.'); window.location.href='../views/Inicio.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <h2>Finalizar La Compra</h2>
    <link rel="stylesheet" href="../Style/checkout_style.css">

    <table>
        <tr>
            <td>Producto</td>
            <td>Precio (Unidad) </td>
            <td>Cantidad</td>
            <td>Total</td>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $producto):?>
            <tr>
                <td><?= htmlspecialchars($producto['nombre'])?></td>
                <td><?= number_format(floatval($producto['precio']),2)?></td>
                <td><?= $producto['cantidad'] ?></td>
                <td><?= number_format(floatval($producto['precio_total']),2)?></td>
            </tr>
            <?php endforeach; ?>
    </table>

    <h3>Total: $<?= number_format(array_sum(array_column($_SESSION['carrito'],'precio_total')),2) ?></h3>

    <form action="../controllers/procesar_pago.php" method="POST">
            <label for="" name="nombre" id="nombre">Nombre: <input type="text" name="nombre" required></label><br>
            <label for="" name="direccion" id="direccion">Dirección: <input type="text" name="direccion" required></label><br>
            <label for="" name="metodo_pago" id="metodo_pago">Metodo de Pago: <select name="metodo_pago">
                <option value="tarjeta">Tarjeta De Credito/Debito</option>
                <option value="paypal">Paypal</option>
            </select></label><br>
            <button type="submit" name="finalizar_compra">Confirmar Pedido</button>
    </form>
    
</body>
</html>