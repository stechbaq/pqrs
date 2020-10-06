<?php

    require('../API/db/connection.php');

    error_reporting(0);

    $records = $conn->prepare("SELECT id, username FROM accounts WHERE rol = 'USUARIO'");
    $records->execute();
    $users = $records->fetchAll();

    $statement = null;
    $conn = null;