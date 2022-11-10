<?php session_start();?>

<?php include '../connexion_bdd.php';?>

<?php
 if (isset($_POST) & !empty($_POST)) {
    $mdp = htmlspecialchars($_POST['motPass']);
    $pwd = htmlspecialchars($_POST['mot_pass']);
    $pwds = htmlspecialchars($_POST['passwords']);

    //Recuperation des donnees de l'utilisateurs 
        $req = $conn->prepare("SELECT * FROM utilisateurs WHERE id_utilisateurs = ?");
        $req->execute(array($_SESSION['id_utilisateurs']));
        $data = $req ->fetch();

        
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3' crossorigin='anonymous'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>
    <link rel='stylesheet' href='modification.css'>
    <title>Mdifier mot de passe</title>
</head>
<body>
<h1>Changer mot de passe</h1>
<a href="admin.php"><button type="button" class="btn btn-primary">Retour</button></a> 
<div class='container'>
        <form action='' method='POST' class='form-group'>
        <div class='form-group col-md-12' >
            <label><span class='pass'>Ancien mot de passe*</span></label>
            <input type='password' name='motPass' class='form-control' id='word'>
            <span id='pass' class='text-danger'></span>
        </div> <br>

        <div class='form-group col-md-12' >
            <label><span class='pass'>Nouveau mot de passe*</span></label>
            <input type='password' name='mot_pass' class='form-control' id='users'>
            <span id='username' class='text-danger'></span>
        </div> <br>
            
        <div class='form-group col-md-12' >
            <label><span class='pass'>Nouveau mot de passe**</span></label>
            <input type='password' name='passwords' class='form-control' id='mot'>
            <span id='passe' class='text-danger'></span>
        </div><br>
        <button type='submit' class='btn btn-light bouton'>Confirmer</button>
    </div>
</form>
</body>
</html>