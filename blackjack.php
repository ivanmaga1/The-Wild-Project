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
    <title>Blackjack</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/blackjack.js" defer></script>
</head>
<body>
    <h1>🃏 Blackjack</h1>
    <p>Saldo actual: $<?php echo $saldo; ?></p>
    <form id="apuesta-form">
        <input type="number" name="cantidad" placeholder="Cantidad a apostar" min="1" max="<?php echo $saldo; ?>" required>
        <button type="button" onclick="hacerApuesta()">Apostar</button>
    </form>
    <div id="mesa">
        <div id="cartas-crupier"></div>
        <div id="cartas-jugador"></div>
        <div class="botones">
            <button onclick="pedirCarta()">Pedir Carta</button>
            <button onclick="plantarse()">Plantarse</button>
        </div>
    </div>
    <p id="resultado"></p>
</body>
</html>
