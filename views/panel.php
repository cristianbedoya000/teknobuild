<?php 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include '../includes/conexion.php';


/*

if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'){
    echo "<script>alert('Acceso denegado. Solo administradores pueden ingresar.'); window.location.href='Inicio.php';</script>";
    exit();
}*/


if(isset($_POST['Register'])){
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $precio=$_POST['precio'];
    $stock=$_POST['stock'];
    $categoria =$_POST['categoria'];

    if(isset($_FILES['imagen'])){
        $archivo = $_FILES['imagen']['name'];
        $tempPath = $_FILES['imagen']['tmp_name'];
        $uploadPath = "../uploads/" . basename($archivo); // Ruta en la carpeta

        if(move_uploaded_file($tempPath, $uploadPath)){
            $imagenUrl = $uploadPath; // Guardamos la ruta en la BD
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    }

    $insertQuery = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen, categoria) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($insertQuery);
    $stmt->bind_param("ssdiss", $nombre, $descripcion, $precio, $stock, $imagenUrl, $categoria);

    if($stmt->execute()){
        header("location: admin_vista.php");
    }else{
        echo "Error en el registro". $conexion->error;
    }
}


if(isset($_FILES['imagen'])){
    $archivo = $_FILES['imagen']['name'];
    $tempPath = $_FILES['imagen']['tmp_name'];
    $uploadPath = "uploads/" . basename($archivo);

    // Mueve el archivo a la carpeta uploads
    if(move_uploaded_file($tempPath, $uploadPath)){
        $imagenUrl = $uploadPath;  
    } else {
        echo "Error al subir la imagen.";
    }
}



if (isset($_POST['Eliminar'])) {
    $idEliminar = $_POST['eliminar_id'];
    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $idEliminar);
    if ($stmt->execute()) {
        echo "<script>alert('Producto eliminado correctamente'); window.location.href='admin_vista.php';</script>";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
}

if(isset($_POST['CerrarSesion'])){
    session_start();
    session_destroy();
    header("Location: Inicio.php");
    exit();
}



$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?= $fila['id'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['descripcion'] ?></td>
                <td>$<?= $fila['precio'] ?></td>
                <td><?= $fila['stock'] ?></td>
                <td><img src="<?= str_replace('../','/Store/', htmlspecialchars($fila['imagen'])) ?>" width="80"></td>
                <td>

                    <form method="POST" action="panel.php">
                        <input type="hidden" name="eliminar_id" value="<?= $fila['id'] ?>">
                        <button type="submit" name="Eliminar">Eliminar</button>
                    </form>

                    <form method="POST" action="panel.php">                        
                        <a href="editar_producto.php?id=<?= $fila['id'] ?>">Editar</a>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>