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
    <title>Casino Online 🎰</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🎰 Bienvenido al Casino Online 🎰</h1>
        <p>Saldo actual: $<?php echo $saldo; ?></p>
    </header>
    <main>
        <div class="games">
            <a href="blackjack.php" class="game-btn">🃏 Jugar al Blackjack</a>
            <a href="ruleta.php" class="game-btn">🎡 Jugar a la Ruleta</a>
        </div>
    </main>
</body>
</html>
