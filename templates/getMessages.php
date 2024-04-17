<?php
try {
    include "connection.php";
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM messages");
    $stmt->execute();
    $messageList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($messageList);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
} finally {
    $conn = null;
}
