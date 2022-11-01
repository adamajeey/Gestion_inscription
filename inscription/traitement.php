<?php
include '../connexion_bdd.php';

if (!empty($_POST['email']) &&  !empty($_POST['password'])) { //
$mail = htmlspecialchars($_POST['email']);
$pwd = htmlspecialchars($_POST['password']);
$email = strtolower($mail);

$check = $conn->prepare('SELECT email_utilisateurs, mot_de_passe_utilisateurs, role_utilisateurs FROM utilisateurs WHERE email_utilisateurs = :email_utilisateurs');
$check->bindParam("email_utilisateurs", $email);
$check->execute();
$row =  $check->rowCount();

if($row > 0){
    $data = $check->fetch();
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(password_verify($pwd, $data['mot_de_passe_utilisateurs'])){
            $_SESSION['utilisateurs'] = $data['role_utilisateurs'];
            if ($data['role_utilisateurs'] == 'Administrateur') {
                header('Location:admin.php');
                die();
            }
            elseif($data['role_utilisateurs'] == 'Utilisateur'){
                header('location:user.php');
                die();
            }
        }else{header('Location: connexion.php?login_err=mot_de_passe_utilisateurs'); die();}
    }else{header('Location : connexion.php?login_err=email_utilisateurs'); die();}
}else{header('Location: connexion.php?login_err=already'); die();}
}else{header('Location: connexion.php'); die();} 
?>