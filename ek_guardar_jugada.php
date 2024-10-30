<?php
$servername = "localhost";
$username = "root";
$password = "2602";
$dbname = "ek_ahorcado";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $resultado = $_POST['resultado'];
    $stmt = $conn->prepare("INSERT INTO ek_jugadas (resultado) VALUES (:resultado)");
    $stmt->bindParam(':resultado', $resultado);
    $stmt->execute();
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
