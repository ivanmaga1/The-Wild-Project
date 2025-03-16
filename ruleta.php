<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$saldo = $_SESSION["saldo"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ruleta</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/ruleta.js" defer></script>
</head>
<body>
    <h1>🎡 Ruleta</h1>
    <p>Saldo actual: $<?php echo $saldo; ?></p>
    <form id="apuesta-form">
        <input type="number" name="cantidad" placeholder="Cantidad a apostar" min="1" max="<?php echo $saldo; ?>" required>
        <select id="tipo-apuesta">
            <option value="numero">Número (0-36)</option>
            <option value="rojo">Rojo</option>
            <option value="negro">Negro</option>
        </select>
        <input type="number" id="numero" placeholder="Número (0-36)" min="0" max="36" style="display: none;">
        <button type="button" onclick="hacerApuesta()">Apostar</button>
    </form>
    <div class="ruleta-container">
        <div class="ruleta" id="ruleta"></div>
    </div>
    <button onclick="girarRuleta()">🎰 Girar Ruleta</button>
    <p id="resultado"></p>
</body>
</html>
