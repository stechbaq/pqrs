<?php

    require_once('../../db/connection.php');

    //error_reporting(0);

    $id = $_POST['id'];

    $sql = "UPDATE pqrs SET status = 'DELETED' WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
        $response = array('code' => 1, 'message' => 'Registro PQR eliminado con éxito!');
    } else {
        $response = array('code' => -2, 'message' => 'No fue posible eliminar el registro de PQR, intente nuevamente');
    }

    $statement = null;
    $conn = null;

    header("Content-Type: application/json", true);    
    echo json_encode($response);
