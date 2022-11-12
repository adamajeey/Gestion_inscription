<?php include '../connexion_bdd.php';?>


<?php 
    // Recuperation des donnees de l'utilisateurs 
    $req = $conn->prepare('SELECT * FROM `utilisateurs` WHERE matricule_utilisateurs = ? ');
    $req->execute(['utilisateurs']);
    $data = $req->fetch();

    if (isset($_POST) & !empty($_POST)) {
           $prenom = htmlspecialchars($_POST['prenom']);
           $nom = htmlspecialchars($_POST['nom']);
           $email = htmlspecialchars($_POST['email']);

           $id = $_GET['id_utilisateurs']; // On stock l'id recuperer dans l'url
           $datemodif=date('y_m_d');
 
           $update = $conn->prepare("UPDATE utilisateurs SET prenom_utilisateurs = '$prenom', nom_utilisateurs = '$nom', email_utilisateurs = '$email', date_modification_utilisateurs = '$datemodif' WHERE id_utilisateurs = '$id'");
           $update->execute();

           if($update){
            header('location:admin.php? modif=modification reussie!');
        
           }else{
                die('Erreur :' .$e->message());
           }
      }

        ?> 

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3' crossorigin='anonymous'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>
    <link rel='stylesheet' href='modification.css'>
    <title>Modifier</title>
</head>
    <body>
    <h1>Modification</h1>
    <a href="admin.php"><button type="button" class="btn btn-primary">Retour</button></a> 
    <div class='container'>
 <?php 

        if (isset($_GET['id_utilisateurs'])) {
        $id = $_GET['id_utilisateurs'];
        if (!empty($id) && is_numeric($id)) {
            $list = "SELECT * FROM utilisateurs WHERE id_utilisateurs = $id";
            $resutl = $conn->query($list);
            $row = $resutl->fetch();
                $id = $row['id_utilisateurs'];
                $prenom = $row['prenom_utilisateurs'];
                $nom = $row['nom_utilisateurs'];
                $email = $row['email_utilisateurs'];

            }
        }
        ?> 

<form action='' method='POST' class='form-group' onsubmit="return validation()">
<div class='form-group col-md-12' >
    <label><span class='pass'>Prenom*</span></label>
    <input type='text' name='prenom' class='form-control' id='user'  <?php echo " value='$prenom'"?>>
    <span id='username' class='text-danger'></span>
</div> <br>

<div class='form-group col-md-12' >
    <label><span class='pass'>Nom*</span></label>
    <input type='text' name='nom' class='form-control' id='users'  <?php echo " value='$nom'"?>>
    <span id='usernames' class='text-danger'></span>
</div> <br>
	
<div class='form-group col-md-12' >
    <label><span class='pass'>Email*</span></label>
    <input type='text' name='email' class='form-control' id='mail'   <?php echo " value='$email'"?>>
    <span id='emailid' class='text-danger'></span>
</div><br>
<button type='submit' class='btn btn-light bouton'>Modifier</button>
</form>;
</div>
<script>

function validation() {

    let user= document.getElementById('user').value;
    let nom= document.getElementById('users').value;
    let email= document.getElementById('mail').value;
    let regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

    if (user.trim() == "") {
    document.getElementById('username').innerHTML ="Veuillez remplir ce champ svp!";
    setTimeout(() => {
      document.getElementById("username").innerHTML =""; 
      }, 2000);
    return false;           
  }

  if (nom.trim() == "") {
    document.getElementById('usernames').innerHTML ="Veuillez remplir ce champ svp!";
    setTimeout(() => {
      document.getElementById('usernames').innerHTML =""; 
      }, 2000);
    return false;        
  }

  if (email==" " || email =="") {
          document.getElementById("emailid").innerHTML ="Veuillez remplir ce champ svp!";
          setTimeout(() => {
          document.getElementById("emailid").innerHTML =""; 
          }, 2000);
          return false;
      } 
      if (!email.match(regex)){
        document.getElementById('emailid').innerHTML = "L'adresse email incorrect!";
          document.getElementById('emailid').style.color = 'red';
          setTimeout(() => {
            document.getElementById("emailid").innerHTML =""; 
            }, 2000);
            return false;
      }

}
</script>
</body>
</html>