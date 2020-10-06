<?php

    require_once('../../db/connection.php');

    error_reporting(0);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $records = $conn->prepare('SELECT id, fullname, username, pass, rol FROM accounts WHERE username = :username');
    $records->bindParam(':username', $username);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (count($results) > 0 && password_verify($password, $results['pass'])) {
        $response = array('code' => 1, 'message' => 'OK', 'fullname' => $results['fullname']);
        session_start();
        $_SESSION['ID'] = $results['id'];
        $_SESSION['FULLNAME'] = $results['fullname'];
        $_SESSION['ROLE'] = $results['rol'];
    } else {
        $response = array('code' => -1, 'message' => 'Las credenciales no coinciden');
    }

    $statement = null;
    $conn = null;

    header("Content-Type: application/json", true);    
    echo json_encode($response);
