<?php
date_default_timezone_set('Europe/Paris');

if (
    !empty($_POST["pseudo"])
    && !empty($_POST["content"])
) {

    require_once "config/connexion.php";

    // Vérifie d'abord si le pseudo existe déjà dans la table user
    $checkDuplicate = $connexion->prepare(
        "SELECT * FROM `user` WHERE `pseudo` = ?"
    );
    $checkDuplicate->execute([$_POST["pseudo"]]);
    $user = $checkDuplicate->fetch();
    

    if (empty($user)) {
        $preparedRequest = $connexion->prepare(
            "INSERT INTO `user`(`pseudo`) VALUES(?) "
        );
        $preparedRequest->execute([
            $_POST["pseudo"]
        ]);
        $idUser = $connexion->lastInsertId();
    }else{
        $idUser =$user['id'];
    }

    $preparedRequest = $connexion->prepare(
        "INSERT INTO `message` (`user_id` , `content` , `adresse_ip` , `date_time`)VALUES(?,?,?,?)"
    );
    $preparedRequest->execute([
        $idUser,
        $_POST["content"],
        $_SERVER["REMOTE_ADDR"],
        date("Y-m-d H:i:s"),
    ]);

    header("Location: index.php");

} else {
    echo "Merci de remplir les champs!!";
}
