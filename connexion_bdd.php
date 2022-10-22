<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'gahdamns';
    try{
        $conn = new PDO("mysql:host=$servername;dbname=Gestion_inscription", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '';
    }
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }
?>