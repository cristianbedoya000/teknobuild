<?php
session_start();
include('../includes/conexion.php');

if(isset($_POST['finalizar_compra'])){
    $nombre = $_POST['nombre'];
    $direccion =$_POST['direccion'];
    $metodo_pago = $_POST['metodo_pago'];
    $total = array_sum(array_column($_SESSION['carrito'], 'precio_total'));

    $sql = "INSERT INTO pedidos (nombre, direccion, metodo_pago, total) VALUES (?,?,?,?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssd", $nombre, $direccion, $metodo_pago, $total);
    $stmt->execute();

    $pedido_id = $stmt->insert_id;

    foreach($_SESSION['carrito'] as $producto){
        $sql_producto = "INSERT INTO pedido_productos (pedido_id, producto_id, cantidad, precio) VALUES (?,?,?,?)";
        $stmt_producto = $conexion->prepare($sql_producto);
        $stmt_producto->bind_param("iiid", $pedido_id, $producto['id'],$producto['cantidad'], $producto['precio_total']);
        $stmt_producto->execute();
    }
    unset($_SESSION['carrito']);
    echo "<script>alert('Compra realizada con éxito. ¡Gracias por tu pedido!'); window.location.href='../views/Inicio.php';</script>";
}

?>
