<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
?>

<header class="navbar_top">
    <div class="logo-teknobuild">
        <a href="../views/Inicio.php">
            <img src="../Assets/teknobuild.png" alt="" class="logo-img">
        </a>
    </div>
    <ul class="nav_links">
        <li><button class="logout-button"><a href="../views/Inicio.php">Inicio</a></li></button>
        <?php if(isset($_SESSION['rol'])): ?>
            <li><button class="logout-button"><a href="../views/carrito_vista.php">Carrito</a></button></li>
            <li>
                <form method="POST" action="../views/panel.php" class="logout-form">
                    <input type="hidden" name="cerrarsesion">
                    <button type="submit" name="CerrarSesion" class="logout-button">Cerrar Sesion</button>
                </form>
            </li>
            
            <?php if($_SESSION['rol'] === 'admin'): ?>
                <li><button class="logout-button"><a href="../views/admin_vista.php">Panel</a></button></li> 
            <?php endif; ?>   
        <?php else: ?>            
            <li><button class="logout-button"><a href="../views/registro_usuario.php">Login</a></button></li>
            
        <?php endif; ?>
    </ul>
</header>

<nav class="navbar_categorias">
    <ul class="categorias_menu">
        <li><a href="#pc"><i class="fa-solid fa-computer"></i><br><span>PC's ARMADOS</span></a></li>
        <li><a href="#board"><i class="fa-solid fa-tablet-button"></i><br><span>BOARD</span></a></li>
        <li><a href="#cpu"><i class="fa-solid fa-microchip"></i><br><span>CPU</span></a></li>
        <li><a href="#gpu"><i class="fa-solid fa-gamepad"></i><br><span>GPU</span></a></li>
        <li><a href="#ram"><i class="fa-solid fa-memory"></i><br><span>RAM</span></a></li>
        <li><a href="#almacenamiento"><i class="fa-solid fa-hard-drive"></i><br><span>ALMACENAMIENTO</span></a></li>
        <li><a href="#fuente_poder"><i class="fa-solid fa-plug"></i><br><span>FUENTE DE PODER</span></a></li>
        <li><a href="#cooling"><i class="fa-solid fa-fan"></i><br><span>COOLING</span></a></li>
        <li><a href="#case"><i class="fa-solid fa-chess-rook"></i><br><span>CASE</span></a></li>
        <li><a href="#mouse"><i class="fa-solid fa-computer-mouse"></i><br><span>MOUSE</span></a></li>
        <li><a href="#teclado"><i class="fa-solid fa-keyboard"></i><br><span>TECLADO</span></a></li>  
    </ul>
</nav>
