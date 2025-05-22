<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['agregar'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "Producto sin nombre"; // Evita NULL
    $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0.00; // Evita NULL

    // Si el producto ya está en el carrito, aumenta la cantidad
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += 1;
        $_SESSION['carrito'][$producto_id]['precio_total'] = $_SESSION['carrito'][$producto_id]['cantidad'] * $_SESSION['carrito'][$producto_id]['precio'];
    } else {
        $_SESSION['carrito'][$producto_id] = [
            'id' => $producto_id,
            'nombre' => $nombre,
            'precio' => $precio,
            'precio_total'=>$precio,
            'cantidad' => 1
        ];
    }
    $_SESSION['mensaje_carrito'] = "¡Producto añadido: $nombre!";
    header("Location: ../views/carrito_vista.php");
    exit();
}

if (isset($_POST['eliminar'])) {
    $producto_id = $_POST['producto_id'];
    unset($_SESSION['carrito'][$producto_id]);

    header("Location: ../views/carrito_vista.php");
    exit();
}
?>
