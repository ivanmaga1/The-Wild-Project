<?php
session_start();

$servername = "localhost";
$username = "admincas";
$password = "castelao";
$database = "proyectoaso";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];

    $sql = "SELECT id, nombre, password, saldo FROM usuarios WHERE nombre='$nombre'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["usuario_id"] = $row["id"];
            $_SESSION["nombre"] = $row["nombre"];
            $_SESSION["saldo"] = $row["saldo"];
            header("Location: index.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</body>
</html>
