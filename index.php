<?php session_start();?>
<?php include 'connexion_bdd.php';?>

<?php


if (isset($_POST['email'],$_POST['password'])) {
    

if (!empty($_POST['email']) &&  !empty($_POST['password'])) { 
$mail = htmlspecialchars($_POST['email']);
$pwd = htmlspecialchars($_POST['password']);
$email = strtolower($mail);

$check = $conn->prepare('SELECT email_utilisateurs, mot_de_passe_utilisateurs, role_utilisateurs FROM utilisateurs WHERE email_utilisateurs = :email_utilisateurs');
$check->bindParam("email_utilisateurs", $email);
$check->execute();
$row =  $check->rowCount();

if($row > 0){
    $check = $conn->prepare('SELECT * FROM utilisateurs WHERE email_utilisateurs = :email_utilisateurs');
    $check->bindParam("email_utilisateurs", $email);
    $check->execute();
    $row =  $check->rowCount();
    $data = $check->fetch();
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

        //verifie si le mot de passe exit
        if(password_verify($pwd, $data['mot_de_passe_utilisateurs'])){

            //Session qui redirige
            $_SESSION['matricule_utilisateurs'] = $data['matricule_utilisateurs'];
            $_SESSION['id_utilisateurs'] = $data['id_utilisateurs'];
            $_SESSION['matricule_utilisateurs'] = $data['matricule_utilisateurs'];
            $_SESSION['prenom_utilisateurs'] = $data['prenom_utilisateurs'];
            $_SESSION['nom_utilisateurs'] = $data['nom_utilisateurs'];
            $_SESSION['email_utilisateurs'] = $data['email_utilisateurs'];

            $_SESSION['utilisateurs'] = $data['role_utilisateurs'];

            if ($data['role_utilisateurs'] == 'Administrateur' && $data['etat_utilisateurs'] == 0) {
                header('Location:./inscription/admin.php');
                die();
            }
            elseif($data['role_utilisateurs'] == 'Utilisateur' && $data['etat_utilisateurs'] == 0){
                header('location:./inscription/user.php');
                die();
            }
        }else{header('Location: index.php?login_err=mot_de_passe_utilisateurs'); die();}
    }else{header('Location : index.php?login_err=email_utilisateurs'); die();}
}else{header('Location: index.php?login_err=already'); die();}
}else{header('Location: index.php'); die();
}
}
?>


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
<?php
           if(isset($_GET['login_err']))
           {
               $err = htmlspecialchars($_GET['login_err']);
 
               switch($err)
               {
                   case 'mot_de_passe_utilisateurs':
                       ?>
                           <div class="alert alert-danger">
                               <strong>Erreur</strong>  email ou mot de passe incorrect
                           </div>
                       <?php
                   break;
                   case 'email_utilisateurs':
                       ?>
                           <div class="alert alert-danger">
                               <strong>Erreur</strong> email incorrect
                           </div>
                       <?php
                   break;
             
                    case 'already':
                       ?>
                           <div class="alert alert-danger">
                               <strong>Erreur</strong> compte non existant
                           </div>
                       <?php
                   break;
               }
       
            }
    ?>
<form class="needs-validation" action="" method="post" onsubmit="return verifinput()">
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
            <div class="col-md-6 bouton" style="margin-left: 105px;">
              <input class="btn btn-light" type="submit" value="Se connecter">
            </div>
            <a href="./inscription/Inscription.php" style="color:white"> S'inscrire</a>
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

        if (password.trim() == "") {
            document.getElementById('mdp').innerHTML ="Ce champ ne doit pas etre vide!";
            return false;
         
         }
         }
</script>
</html>