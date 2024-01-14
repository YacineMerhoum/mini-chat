<?php
    require_once "../config/connexion.php";

    $preparedRequest = $connexion->prepare(
        "SELECT pseudo FROM `user` "
    );

    $preparedRequest->execute();

    $user = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($user);

    
