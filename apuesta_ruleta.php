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
$cantidad = $data["cantidad"];
$tipoApuesta = $data["tipoApuesta"];
$numero = $data["numero"];
$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT saldo FROM usuarios WHERE id=$usuario_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row["saldo"] >= $cantidad) {
    $nuevo_saldo = $row["saldo"] - $cantidad;
    $sql = "UPDATE usuarios SET saldo=$nuevo_saldo WHERE id=$usuario_id";
    $conn->query($sql);
    $_SESSION["saldo"] = $nuevo_saldo;
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Saldo insuficiente"]);
}
?>
