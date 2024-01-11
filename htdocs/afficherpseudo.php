<?php 
require_once "/config/connexion.php";

$preparedRequest = $connexion->prepare(
    "SELECT * FROM user "
);
$preparedRequest->execute();
$message = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);

var_dump($message);
?>