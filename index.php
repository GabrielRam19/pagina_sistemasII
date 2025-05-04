<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Bienvenido <?php echo $_SESSION["user"]; ?>!</h1>
<a href="usuarios.php">Ir al CRUD de usuarios</a> |
<a href="logout.php">Cerrar sesión</a>