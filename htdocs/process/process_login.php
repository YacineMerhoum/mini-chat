<?php
session_start();

if (
    !empty($_POST["username"])  
    // vérifie si la variable $_POST["username"] n'est pas vide
) {

    require_once "../config/connexion.php";

    // Vérifie d'abord si le pseudo existe déjà dans la table user
    $checkDuplicate = $connexion->prepare(
        "SELECT * FROM `user` WHERE `pseudo` = ?"
    );
    $checkDuplicate->execute([$_POST["username"]]);
    $user = $checkDuplicate->fetch();
    

    if (empty($user)) {
        $preparedRequest = $connexion->prepare(
            "INSERT INTO `user`(`pseudo`) VALUES(?) "
        );
        $preparedRequest->execute([
            $_POST["username"]
        ]);
        $idUser = $connexion->lastInsertId(); // récupère l'ID généré automatiquement lors de l'insertion du nouvel utilisateur.
        $_SESSION["iduser"] = $idUser;


        $_SESSION["username"] = $_POST["username"];
        



    }else{
        $idUser =$user['id'];

        $_SESSION["iduser"] = $idUser;
        $_SESSION["username"] = $_POST["username"];


        
    }
    header("Location: ../index.php");
}


