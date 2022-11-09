<?php include '../connexion_bdd.php';?>

<?php
            if($_SESSION['email_utilisateurs'] !== ""){
              session_unset();
              session_destroy(); 
              header("location:../index.php");
            }
    ?>

