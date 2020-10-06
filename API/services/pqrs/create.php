<?php

    function getLimitDate($date, $type) {
        if ($type === 'PETICION') {
            return date("Y-m-d", strtotime($date."+ 7 days")); 
        } elseif ($type === 'QUEJA') {
            return date("Y-m-d", strtotime($date."+ 3 days")); 
        } elseif ($type === 'RECLAMO') {
            return date("Y-m-d", strtotime($date."+ 2 days")); 
        }
        return $date;
    }

    require_once('../../db/connection.php');

    error_reporting(0);

    $type = $_POST['type'];
    $issue = $_POST['issue'];
    $username = $_POST['username'];
    $userId = $_POST['userId'];
    $status = "NEW";

    $sql = "INSERT INTO pqrs (type, issue, username, userId, status, createdAt, limitDate) VALUES (:type, :issue, :username, :userId, :status, :createdAt, :limitDate)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':type', $type);
    $statement->bindParam(':issue', $issue);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':userId', $userId);
    $statement->bindParam(':status', $status);

    // Get current date and to calculate limit date
    $currentDate = date('Y-m-d');
    $limitDate = getLimitDate($currentDate, $type);

    $statement->bindParam(':createdAt', $currentDate);
    $statement->bindParam(':limitDate', $limitDate);
    
    if ($statement->execute()) {
        $response = array('code' => 1, 'message' => 'Registro PQR registrado con éxito!');
    } else {
        $response = array('code' => -2, 'message' => 'No fue posible crear el registro de PQR, intente nuevamente');
    }

    $statement = null;
    $conn = null;

    header("Content-Type: application/json", true);    
    echo json_encode($response);
