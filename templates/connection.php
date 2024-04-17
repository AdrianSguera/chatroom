<?php

function connect()
{
    $servername = "localhost";
    $db_username = "root";
    $db_password = "1234";
    $database = "phpweb";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function login($input_username, $input_password)
{
    try {
        $conn = connect();

        // Consulta preparada para evitar inyecciones de SQL
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $input_username);
        $stmt->bindParam(':password', $input_password);
        $stmt->execute();

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}

function register($input_username, $input_password)
{
    try {
        $conn = connect();

        $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $input_username);
        $stmt->bindParam(':password', $input_password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return false;
    } finally {
        $conn = null;
    }
}

function saveMessage($message)
{
    try {
        $conn = connect();

        $iduser = getIdByUsername($_SESSION['username']);
        $stmt = $conn->prepare("INSERT INTO messages (content,iduse) VALUES (:content, :iduser)");
        $stmt->bindParam(':content', $message);
        $stmt->bindParam(':iduser', $iduser);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}

function getIdByUsername($username)
{
    try {
        $conn = connect();

        $stmt = $conn->prepare("SELECT iduser FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        // Devuelve solo el primer resultado (asumiendo que el nombre de usuario es único)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['iduser'];
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return false;
    } finally {
        $conn = null;
    }
}
