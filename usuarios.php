<?php
session_start();
require 'db.php';
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Agregar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')");
}

// Eliminar usuario
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn->query("DELETE FROM usuarios WHERE id = $id");
}

// Obtener usuarios
$usuarios = $conn->query("SELECT * FROM usuarios");
?>

<h2>CRUD de Usuarios</h2>
<form method="POST">
    Nombre: <input type="text" name="nombre">
    Email: <input type="email" name="email">
    Contraseña: <input type="password" name="password">
    <button type="submit">Agregar</button>
</form>

<table border="1">
    <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th></tr>
    <?php while ($u = $usuarios->fetch_assoc()): ?>
        <tr>
            <td><?= $u["id"] ?></td>
            <td><?= $u["nombre"] ?></td>
            <td><?= $u["email"] ?></td>
            <td><a href="?delete=<?= $u["id"] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a></td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="index.php">Volver</a>