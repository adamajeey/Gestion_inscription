<!-- <?php
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
            $_SESSION['photo_utilisateurs'] = $data['photo_utilisateurs'];
            $_SESSION['email_utilisateurs'] = $data['email_utilisateurs'];

            $_SESSION['utilisateurs'] = $data['role_utilisateurs'];

            if ($data['role_utilisateurs'] == 'Administrateur' && $data['etat_utilisateurs'] == 0) {
                header('Location:admin.php');
                die();
            }
            elseif($data['role_utilisateurs'] == 'Utilisateur' && $data['etat_utilisateurs'] == 0){
                header('location:user.php');
                die();
            }
        }else{header('Location: connexion.php?login_err=mot_de_passe_utilisateurs'); die();}
    }else{header('Location : connexion.php?login_err=email_utilisateurs'); die();}
}else{header('Location: connexion.php?login_err=already'); die();}
}else{header('Location: connexion.php'); die();} 
?> -->