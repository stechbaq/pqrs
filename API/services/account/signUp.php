<?php

    require_once('../../db/connection.php');

    error_reporting(0);

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $records = $conn->prepare('SELECT COUNT(*) AS QUANTITY FROM accounts WHERE username = :username');
    $records->bindParam(':username', $username);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (intval($results['QUANTITY']) > 0) {
        $response = array('code' => -1, 'message' => 'El usuario ya existe');
    } else {
        $sql = "INSERT INTO accounts (fullname, username, pass) VALUES (:fullname, :username, :pass)";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':fullname', $fullname);
        $statement->bindParam(':username', $username);
        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
        $statement->bindParam(':pass', $encryptedPassword);

        if ($statement->execute()) {
            $response = array('code' => 1, 'message' => 'Cuenta de usuario creada con éxito!');
        } else {
            $response = array('code' => -2, 'message' => 'No fue posible crear la cuenta de usuario, intente nuevamente');
        }
    }

    $statement = null;
    $conn = null;

    header("Content-Type: application/json", true);    
    echo json_encode($response);
