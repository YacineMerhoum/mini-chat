<?php
    require_once "../config/connexion.php";

    $preparedRequest = $connexion->prepare(
        "SELECT * FROM `message` INNER JOIN user ON message.user_id = user.id "
    );

    $preparedRequest->execute();

    $content = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($content);

    
