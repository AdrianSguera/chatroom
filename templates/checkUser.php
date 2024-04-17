<?php
// Leer la solicitud POST como JSON
$json_data = file_get_contents('php://input');

// Decodificar los datos JSON en un array asociativo de PHP
$data = json_decode($json_data, true);

try {
    if (isset($data)) {
        $username = $data['data'];
        include 'connection.php';
        $conn = connect();
        $stmt = $conn->prepare('select * from user where username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            header('Content-Type: application/json');
            echo json_encode('Username already exists');
        } else {
            header('Content-Type: application/json');
            echo json_encode('');
        }
    } else {
        echo "No se recibieron datos en el formato esperado";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    return false;
} finally {
    $conn = null;
}
