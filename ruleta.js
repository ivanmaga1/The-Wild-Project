function hacerApuesta() {
    let cantidad = document.getElementById("cantidad").value;
    let tipoApuesta = document.getElementById("tipo-apuesta").value;
    let numero = document.getElementById("numero").value;

    if (cantidad <= 0 || cantidad > <?php echo $_SESSION['saldo']; ?>) {
        alert("Cantidad inválida.");
        return;
    }

    fetch("apuesta_ruleta.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cantidad: cantidad, tipoApuesta: tipoApuesta, numero: numero })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Apuesta realizada. ¡Buena suerte!");
        } else {
            alert("Error: " + data.message);
        }
    });
}

function girarRuleta() {
    let ruleta = document.getElementById("ruleta");
    let giro = Math.floor(Math.random() * 3600) + 1440; // Giro entre 1440° y 3600° (4 a 10 vueltas)
    
    ruleta.style.transition = "transform 4s ease-out";
    ruleta.style.transform = `rotate(${giro}deg)`;
    
    setTimeout(() => {
        let resultado = Math.floor(Math.random() * 37); // Número entre 0 y 36
        fetch("resultado_ruleta.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ resultado: resultado })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("resultado").innerText = `Resultado: ${resultado}. ${data.mensaje}`;
            alert(`Saldo actualizado: $${data.saldo}`);
            location.reload();
        });
    }, 4000);
}
