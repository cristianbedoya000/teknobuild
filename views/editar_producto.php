<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../includes/conexion.php';

// Validar si se está solicitando la edición de un producto
if(isset($_GET['id'])){
    $id_editar = $_GET['id'];

    $editQuery = "SELECT * FROM productos WHERE id=?";
    $stmt = $conexion->prepare($editQuery);
    $stmt->bind_param("i", $id_editar);
    $stmt->execute();
    $resultadoEditar = $stmt->get_result();

    if($resultadoEditar->num_rows > 0){
        $productoEditar = $resultadoEditar->fetch_assoc();
    } else {
        echo "<script>alert('Producto no encontrado'); window.location.href='admin_vista.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID de producto no válido'); window.location.href='admin_vista.php';</script>";
    exit();
}

// Procesar la actualización cuando el formulario se envía
if (isset($_POST['Modificar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $archivo = $_FILES['imagen']['name'];
        $tempPath = $_FILES['imagen']['tmp_name'];
        $uploadPath = "uploads/" . basename($archivo);

        if(move_uploaded_file($tempPath, $uploadPath)){
            $imagenUrl = $uploadPath;
        } else {
            echo "<script>alert('Error al subir la imagen');</script>";
            exit();
        }
    } else {
        $imagenUrl = $_POST['imagen_actual'];
    }

    $queryUpdate = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, categoria = ?, imagen = ? WHERE id = ?";
    $stmt = $conexion->prepare($queryUpdate);
    $stmt->bind_param("ssdissi", $nombre, $descripcion, $precio, $stock, $categoria, $imagenUrl, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Producto actualizado correctamente'); window.location.href='admin_vista.php';</script>";
        exit();
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Producto - TEKNOBUILD</title>
    <link rel="stylesheet" href="../Style/listar.css">
    <link rel="stylesheet" href="../Style/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<?php include'../includes/navbar.php';?>
<body>
    <div class="container" id="EditarProducto">
        <h2 class="form-title">EDITAR PRODUCTO</h2>
        <form action="editar_producto.php?id=<?= $productoEditar['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $productoEditar['id'] ?>">

            <div class="input-group">
                <i class="fa-solid fa-signature"></i>
                <input type="text" name="nombre" placeholder="Nombre del Producto" value="<?= $productoEditar['nombre'] ?>" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-cloud"></i>
                <input type="text" name="descripcion" placeholder="Descripción" value="<?= $productoEditar['descripcion'] ?>" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-money-bill-1-wave"></i>
                <input type="number" name="precio" placeholder="Precio" value="<?= $productoEditar['precio'] ?>" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-hashtag"></i>
                <input type="number" name="stock" placeholder="Cantidad" value="<?= $productoEditar['stock'] ?>" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-images"></i>
                <input type="file" name="imagen">
                <input type="hidden" name="imagen_actual" value="<?= $productoEditar['imagen'] ?>">
                <img src="<?= $productoEditar['imagen'] ?>" width="100" style="margin-top: 10px; border-radius: 10px;">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-layer-group"></i>
                <input type="text" name="categoria" placeholder="Categoría" value="<?= $productoEditar['categoria'] ?>" required>
            </div>

            <button type="submit" class="btn" name="Modificar">Guardar Cambios</button>
        </form>
        <div>
            <p>¿Deseas cancelar?</p>
            <a href="admin_vista.php"><button class="btn">Volver al Inventario</button></a>
        </div>
    </div>
</body>
</html>
