<?php

    session_start();
    $userId = $_SESSION['ID'];
    $role = $_SESSION['ROLE'];

    require('../API/db/connection.php');

    error_reporting(0);

    $query = "SELECT id, type, issue, username, status, createdAt, limitDate FROM pqrs WHERE status <> 'DELETED'";
    if ($role == 'USUARIO') {
        $query = "SELECT id, type, issue, username, status, createdAt, limitDate FROM pqrs WHERE userId = $userId AND status <> 'DELETED'";
    }

    $records = $conn->prepare($query);
    $records->execute();
    $pqrs = $records->fetchAll();

    $statement = null;
    $conn = null;