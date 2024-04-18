<?php
try {
    session_start();
    include "connection.php";
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM messages");
    $stmt->execute();
    $messageList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($messageList as &$message) {
        $message['username'] = getUsernameById($message['iduser']);
        $message['session'] = $_SESSION['username'];
        $message['image'] = getImageById($message['iduser']);
    }
    header('Content-Type: application/json');
    echo json_encode($messageList);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
} finally {
    $conn = null;
}
