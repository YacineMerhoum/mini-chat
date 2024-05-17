<?php
session_start();
// include "./config/debug.php";



require_once './config/connexion.php';
// requete pour le chat
$preparedRequest = $connexion->prepare(
  "SELECT * FROM `message` INNER JOIN user ON message.`user_id` = user.id "
);

$preparedRequest->execute();
$messages = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);


?>
<!-- requete pour afficher les pseudos -->
<?php
$preparedRequest = $connexion->prepare(
  "SELECT pseudo FROM `user` "
);

$preparedRequest->execute();
$displayPseudo = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mini Chat de Yizzy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg bg-black navbar-dark ">
      <div class="container-md ">
        <a class="navbar-brand fs-2" href="minichat.dvl">
          <i class="fa-regular fa-comment-dots fa-beat fa-2xl" style="color: #1c71d8;">
          </i> Mini-Chat</a>



        <!-- input session indentifiant -->
        <form action="./process/process_login.php" method="post">

          <input name="username" type="text" id="username" placeholder="Votre identifiant">
          <button type="submit" class="btn btn-white">
            <i class="fa-solid fa-user fa-beat fa-lg" style="color: #26a269;"></i>
          </button>

          <p>

            <?php if (!empty($_SESSION["username"])) {
              echo '<p class="text-success fs-3">' . "Bienvenue " .  $_SESSION["username"] . " " .
              "<i class='fa-solid fa-face-smile ' style='color: #FFD43B;'></i>" . '</p>';
            } else {
              // Afficher autre chose ou ne rien afficher si la session n'est pas ouverte
              echo '<p class="text-warning fs-3">Session non ouverte</p>';
            }; ?>
          </p>

        </form>
        <!-- log out  -->
        <a href="/config/log-out.php">
          <i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ed333b;"></i>
        </a>





      </div>
    </nav>
  </header>

  <!-- chat  -->
  <div class="container text-center mt-5" >
    <div class="row align-items-end">

      <div class="col-9 bg-secondary rounded-5 bg-dark  scroll" id="affichageMessage">

        <?php foreach ($messages as $key) { ?>
          <?php $text_style = $key['pseudo'] ===  $_SESSION['username'] ? 'text-end' : 'text-start'; ?>
          <div class="message">
            <div class="chat <?= $text_style ?>">
              <?= $key["date_time"] ?>
              <?= $key["pseudo"] ?>
            </div>
            <div class="chat2 <?= $text_style ?>">
              <?= $key["content"] ?>
            </div>
          </div>

        <?php } ?>

      </div>


      <div class="col-1">
        <!-- colone invisible -->
      </div>
      <div class="col-2 bg-white rounded-5  scroll" id="displayid" >
        <?php foreach ($displayPseudo as $key2) { ?>
          <div class="displaypseudo">

            <?= $key2["pseudo"] ?> <i class="fa-solid fa-circle fa-fade" style="color: #2ec27e;"></i><br>
          </div>



        <?php } ?>





      </div>

    </div>
  </div>
  <!-- formulaires  -->
  <form action="message.php" method="post" id="messageForm">
    <div class="container text-center  mt-5 ">
      <div class="row align-items-end">
        <div class="col-9 bg-secondary rounded-5 bg-dark" id="connexion">
          <div class="mb-3">

            <label for="pseudo" class="form-label fs-1 text-primary"><strong>Pseudo</strong></label>
            <input id="pseudo" type="pseudo" class="form-control rounded-pill" name="pseudo" placeholder="Votre pseudo">
            <div class="form-text">Merci de mettre un pseudo respectueux</div>
            <br>



            <!-- message -->
            <div class="mb-3">
              <label for="read" class="form-label fs-1 text-primary "><strong>Votre message</strong></label>
              <input id="content" type="read" class="form-control rounded-pill" name="content" placeholder="Ecrivez-ici votre message">
              <!-- bouton --><br>

              <input type="hidden" id="ipUser" value="<?= $_SERVER['REMOTE_ADDR']?>"></input>




              <button type="submit" id="button" class="btn btn-primary btn-lg ">Envoyer</button>

            </div>

          </div>

        </div>


        <div class="col-1">
          <!-- colonne invisible -->
        </div>
        <div class="col-2 bg-white">


        </div>

      </div>
    </div>
  </form>
  <br><br>


  <footer class="p-5 text-center ">
    <br>
    <i class="fa-solid fa-cat fa-bounce fa-6x" style="color: #3584e4;"></i>
    <br>
    <h1>Merci de respecter les tchatcheurs</h1>
    <p>Tout droit reservés ® Yizzy</p>

  </footer>



  <script src="./index.js"></script>          
  <script src="./display.js"></script>          
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/23471b5a81.js" crossorigin="anonymous"></script>
  
</body>

</html>