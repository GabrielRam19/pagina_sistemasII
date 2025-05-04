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

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $password);
    $stmt->execute();
}

// Eliminar usuario
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Obtener usuarios
$usuarios = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Usuarios</title>
    <style>
        body {
            background-color: #1e1e2f;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }
        h2 {
            color: #d4af37;
        }
        form, table {
            margin: 20px 0;
            background-color: #2e2e3e;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            margin: 5px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: calc(100% - 20px);
        }
        button {
            background-color: #d4af37;
            color: #1e1e2f;
            border: none;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c39b2f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #1e1e2f;
            color: #d4af37;
        }
        td {
            background-color: #3e3e4e;
        }
        a {
            color: #d4af37;
        }
    </style>
</head>
<body>
    <h2>Administración de Usuarios</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Agregar Usuario</button>
    </form>

    <table>
        <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Acción</th></tr>
        <?php while ($u = $usuarios->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($u["id"], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($u["nombre"], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($u["email"], ENT_QUOTES, 'UTF-8') ?></td>
                <td><a href="?delete=<?= htmlspecialchars($u["id"], ENT_QUOTES, 'UTF-8') ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">← Volver al inicio</a></p>
</body>
</html>