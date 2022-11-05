<?php include '../connexion_bdd.php';?>

<?php
// Recuperation des donnees
  if (isset($_POST['submit'])){
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];       
  $email = $_POST['email']; 
  $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['MobileNumber'];
  // $photo = $_POST['nom_photo']; 

  //Verification si email exit deja
  $select_mail = $conn->prepare("SELECT email_utilisateurs FROM `utilisateurs` WHERE email_utilisateurs = ? ");
  $select_mail->execute([$email]);

if ($select_mail->rowCount() > 0)
{
    $message [] = "l'adresse mail existe déja";
} else {
   // insertion des de donnees et auto-generer matricule 
   $insertion = $conn->prepare("INSERT INTO `utilisateurs` (prenom_utilisateurs,nom_utilisateurs, email_utilisateurs, mot_de_passe_utilisateurs, role_utilisateurs) VALUES (?,?,?,?,?)");
   $insertion ->execute (array($prenom, $nom, $email, $mdp,  $role,));
   
   $matricule = 'GR-'. $conn->lastInsertId(); 
   $sql2 = "UPDATE utilisateurs  SET  matricule_utilisateurs = '$matricule' WHERE email_utilisateurs = '$email' ";
   $matricule2 = $conn->prepare($sql2);
   $matricule2->execute();
   $message []  = "inscription reussi, votre matricule: ". $matricule;
}

if (isset($_SESSION['id_utilisateurs'] )) {
  $id = $_SESSION['id_utilisateurs'] ;
}
if(!empty($_FILES["image"]["name"])) { 
// Get file info 
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

// Allow certain file formats 
$allowTypes = array('jpg','png','jpeg','gif'); 
if(in_array($fileType, $allowTypes)){ 
  $image = $_FILES['image']['tmp_name']; 
  $imgContent = addslashes(file_get_contents($image)); 

  // Insert image content into database 
  // $db = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
  $getImage = $conn->query("SELECT photo FROM image WHERE user=$id"); 
  if ($getImage) {
      $conn->query("DELETE FROM image WHERE user=$id");
  }
  $insert = $conn->query("INSERT into image (photo,user) VALUES ('$imgContent',$id)"); 


  if($insert){ 
      $status = 'success'; 
      $statusMsg = "File uploaded successfully."; 
      header('location:admin.php');
  }else{ 
      $statusMsg = "File upload failed, please try again."; 
  }
}else{ 
  $statusMsg = 'Désolé, seule les fichiers JPG, JPEG, PNG, & GIF sont autorisés.'; 
} 
}else{ 
$statusMsg = 'Veillez selectionner une image'; 
}
}




?>



<!-- // Recuperation images -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="inscriptions.css">
    <title>Inscription</title>
</head>
<body>
<h1>Formulaire d'inscription</h1>
<?php
if (isset($message)) {
   foreach($message as $message){
    echo "<div class='message'>
    $message
    </div>";
   }
 } 
?> 


<div class="container">
    <form class="row g-3" action="" method="post" onsubmit="return validation()">

                <div class="form-group col-md-6" >
                  <label>Prenom*</label>
                  <input type="text" name="prenom" class="form-control" id="user" placeholder="">
                  <span id="username" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6" >
                  <label>Nom*</label>
                  <input type="text" name="nom" class="form-control" id="nom" placeholder="">
                  <span id="nom" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                  <label>Mot de passe*</label>
                  <input type="password" name="password" class="form-control" id="password">
                  <span id="passwordid" class="text-danger"></span>

                </div>
                <div class="form-group col-md-6">
                  <label>Confirmer mot de passe*</label>
                  <input type="password" name="Confirmpassword" class="form-control" id="Confirmpassword">
                  <span id="Confirmpasswordid" class="text-danger"></span>
                </div>
              
                <div class="form-group col-md-6">
                  <label>Email*</label>
                  <input type="email" name="email" class="form-control" id="email">
                  <span id="emailid" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                  <label>Role*</label>
                  <select id="mobilenumber" name="MobileNumber"  class="form-select">
                  <option selected></option>
                  <option>Administrateur</option>
                  <option>Utilisateur</option>
                </select>
                  <span id="MobileNumberid" class="text-danger"></span>
                </div>
                
                <div class="col-md-3">
                  <label for="fil" class="form-label">Photo de profil</label>
                  <input type="file" name="image" class="form-control" id="file">
               </div>

                <div class="col-12">
                  <input type="submit" name="submit" id="bouton" class="btn btn-light" value="S'inscrire">
                </div>
                <a href="../index.php" style="color: white; margin-left:90%">Se connecter</a>
              </form>
</div>
<script src="inscription.js"></script>
</body>
</html>