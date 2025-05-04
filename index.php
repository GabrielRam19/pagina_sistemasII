<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Mi Web</title>
    <style>
        body {
            background-color: #1e1e2f;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            text-align: center;
        }
        header {
            background-color: #2e2e3e;
            padding: 20px;
        }
        h1 {
            color: #d4af37;
        }
        .content {
            padding: 50px;
        }
        a {
            color: #d4af37;
            text-decoration: none;
            margin: 10px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION["user"], ENT_QUOTES, 'UTF-8'); ?>!</h1>
    </header>
    <div class="content">
        <p>Gracias por iniciar sesión. Puedes administrar los usuarios del sistema o cerrar sesión.</p>
        <a href="usuarios.php">Administrar Usuarios</a> |
        <a href="logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>