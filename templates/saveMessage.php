<?php

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

try {
    session_start();
    include "connection.php";
    $conn = connect();

    $iduser = getIdByUsername($_SESSION['username']);
    $stmt = $conn->prepare("INSERT INTO messages (content,iduser) VALUES (:content, :iduser)");
    $stmt->bindParam(':content', $data['content']);
    $stmt->bindParam(':iduser', $iduser);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        header('Content-Type: application/json');
        echo json_encode('true');
    } else {
        header('Content-Type: application/json');
        echo json_encode('false');
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
} finally {
    $conn = null;
}
