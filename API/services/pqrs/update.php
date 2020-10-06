<?php

    require_once('../../db/connection.php');

    error_reporting(0);

    $id = $_POST['id'];
    $newStatus = $_POST['newStatus'];

    $sql = "UPDATE pqrs SET status = :newStatus WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':newStatus', $newStatus);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
        $response = array('code' => 1, 'message' => 'Registro PQR actualizado con éxito!');
    } else {
        $response = array('code' => -2, 'message' => 'No fue posible actualizar el registro de PQR, intente nuevamente');
    }

    $statement = null;
    $conn = null;

    header("Content-Type: application/json", true);    
    echo json_encode($response);
