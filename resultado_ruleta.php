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

$data = json_decode(file_get_contents("php://input"), true);
$resultado = $data["resultado"];
$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT cantidad, tipoApuesta, numero FROM apuestas WHERE usuario_id=$usuario_id ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$cantidad = $row["cantidad"];
$tipoApuesta = $row["tipoApuesta"];
$numero = $row["numero"];

$ganador = false;
if ($tipoApuesta === "numero" && $resultado == $numero) {
    $ganador = true;
} elseif ($tipoApuesta === "rojo" && in_array($resultado, [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36])) {
    $ganador = true;
} elseif ($tipoApuesta === "negro" && in_array($resultado, [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35])) {
    $ganador = true;
}

if ($ganador) {
    $premio = ($tipoApuesta === "numero") ? $cantidad * 35 : $cantidad * 2;
    $nuevo_saldo = $_SESSION["saldo"] + $premio;
    $mensaje = "¡Ganaste!";
} else {
    $nuevo_saldo = $_SESSION["saldo"];
    $mensaje = "Perdiste. Inténtalo de nuevo.";
}

$sql = "UPDATE usuarios SET saldo=$nuevo_saldo WHERE id=$usuario_id";
if ($conn->query($sql)) {
    $_SESSION["saldo"] = $nuevo_saldo;
    echo json_encode(["success" => true, "saldo" => $nuevo_saldo, "mensaje" => $mensaje]);
} else {
    echo json_encode(["success" => false]);
}
?>
