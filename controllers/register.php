<?php 
session_start();
include '../includes/conexion.php';

if(isset($_POST['Register'])){
    $username=$_POST['usuario'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $rol="usuario";

    $checkEmail ="SELECT * FROM usuarios WHERE correo='$email'";#correo igual que en la base de datos
    $result = $conexion->query($checkEmail);

    if($result->num_rows > 0){
        echo "<script>alert('¡Email ya registrado!');</script>";
    } else {
        $insertQuery = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($insertQuery);
        $stmt->bind_param("ssss", $username, $email, $passwordHash, $rol);

            if($stmt->execute()){
                header("location: ../views/Inicio.php");
            }else{
                echo "Error en el registro". $conexion->error;
            }
    }
}

if(isset($_POST['Login'])){
    $email=$_POST['correo'];
    $password=$_POST['contraseña'];

    $sql="SELECT id, nombre, correo, contraseña, rol FROM usuarios WHERE correo=?";
    $stmt=$conexion->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        //session_start();
        $row = $result->fetch_assoc();
        
        // Verificar contraseña con password_verify()
        if(password_verify($password, $row['contraseña'])){

            session_regenerate_id();

            
            $_SESSION['id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['correo'] = $row['correo'];            
            $_SESSION['rol'] = $row['rol'];

            if($row['rol'] ==='admin'){
                header("Location: ../views/admin_vista.php");
                exit();
            } else {
                header("Location: ../views/Inicio.php");
                exit();
            }
        } else {
            echo "<script>alert('¡Contraseña incorrecta!');</script>";
        }
    } else {
        echo "¡Usuario no encontrado!";
    }
}
?>