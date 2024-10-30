<?php

$servername = "localhost";
$username = "root";
$password = "2602";
$dbname = "ek_ahorcado";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa"; 
}
catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'register') {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $stmt = $conn->prepare("INSERT INTO ek_jugadores (usuario, contraseña) VALUES (:usuario, :contraseña)");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contraseña', $contraseña);
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso. Puedes iniciar sesión.'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Error al registrar el usuario.'); window.history.back();</script>";
        }
    } else {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        $stmt = $conn->prepare("SELECT * FROM ek_jugadores WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData) {
            if ($contraseña === $usuarioData['contraseña']) {
                $_SESSION['usuario_id'] = $usuarioData['id_jugadores'];
                $_SESSION['usuario'] = $usuarioData['usuario'];
                header("Location: index.html");
                exit();
            } else {
                echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Usuario no encontrado.'); window.history.back();</script>";
        }
    }
}

$conn = null;

?>
