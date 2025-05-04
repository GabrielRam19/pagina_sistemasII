<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if ($user && password_verify($pass, $user["password"])) {
        $_SESSION["user"] = $user["nombre"];
        header("Location: index.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<form method="POST">
    Email: <input type="email" name="email"><br>
    Contraseña: <input type="password" name="password"><br>
    <button type="submit">Entrar</button>
</form>