<?php
$servername = "localhost";
$username = "root";
$password = "2602";
$dbname = "ek_ahorcado";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare("SELECT resultado, fecha FROM ek_jugadas ORDER BY fecha DESC");
    try {
        $stmt->execute();
        $jugadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/ek_style.css">
    <title>Ver Jugadas</title>
</head>

<body>
    <div class="contenedor__todo">
        <h1>Jugadas Realizadas</h1>
        <table>
            <thead>
                <tr>
                    <th>Resultado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($jugadas): ?>
                    <?php foreach ($jugadas as $jugada): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($jugada['resultado']); ?></td>
                            <td><?php echo htmlspecialchars($jugada['fecha']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No hay jugadas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
