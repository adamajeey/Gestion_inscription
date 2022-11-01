<?php include '../connexion_bdd.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="connexion.css">
    <title>Connexion</title>
</head>
<body>
    <h1 style="color: white ;">Accueil</h1>
<div class="container">
<form class="needs-validation" action="traitement.php" method="post" onsubmit="return verifinput()">
    <h2>Connexion</h2>
            <div class="form-group">
                <label class="form-label" for="email"> <span class="pass">Adresse mail*</span></label>
                <input class="form-control" type="text" id="email" name="email">
                <p id="mail"></p>
            </div>
            <div class="form-group">
                <label class="form-label" for="password"> <span class="pass">Mot de passe*</span></label>
                <input class="form-control" type="password" id="password" name="password">
                <p id="mdp"></p>
            </div> <br>
            <div class="col-md-6 bouton">
              <input class="btn btn-light" type="submit" value="Se connecter">
            </div>
            <a href="Inscription.php" style="color:white"> S'inscrire</a>
            </div>
        </form>
       
</body>
<script>
    function verifinput()  
    {
        let email = document.getElementById('email');
        let password = document.getElementById('password');
        let regex = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
        let mail = document.getElementById('mail');
        let mdp = document.getElementById('mdp');

        if (regex.test(document.getElementById('email').value)){
            document.getElementById('email').innerHTML = '';
            return true;
        }
        else{
            mail.innerHTML = "L'adresse email incorrect!";
            mail.style.color = 'red';
            return false;
        }

        if (password.value == "") {
           mdp.innerHTML ="Ce champ ne doit pas etre vide!";
           mdp.style.color = 'red'
           return false;
           
         }
         
         }
</script>
</html>