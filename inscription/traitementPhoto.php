<?php
session_start();
include '../connexion_bdd.php';
if (isset($_POST['submit'])){
/*   var_dump($_FILES);die;
 */  
//ici on verifie si la session de l'utilisateur qui s'est connecté existe
if (isset($_SESSION['id_utilisateurs'])) {
    $id = $_SESSION['id_utilisateurs'];
  }
  //ici on verifie si le champ de l'image est vide ou pas 
  if(!empty($_FILES["image"]["name"])) { 
    // Get file info 
    $fileName = basename($_FILES["image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 

     
        $getImage = $conn->query("SELECT photo FROM images WHERE user=$id"); 
        if ($getImage) {
          $insert = $conn->prepare("UPDATE images SET photo=:photo WHERE id=:id");
        }
        $insert->bindParam(':photo', $imgContent);
        $insert->bindParam(':id', $id);

        /* var_dump($insert);
        exit; */
    
        if($insert->execute()){
          
          $insert = $conn->query("SELECT role_utilisateurs FROM utilisateurs WHERE id_utilisateurs=$id");  
         $role = $insert->fetchColumn();
         
          if ($role == 'Administateur') {
            header('location:admin.php? mes=image inserer avec succes!');
          }
          elseif($role == 'Utilisateur') {
            header('location:user.php? mes=image inserer avec succes!');
          }
         
            $status = 'success'; 
            $statusMsg = "File uploaded successfully."; 
      
        }else{ 
            $statusMsg = "File upload failed, please try again."; 
        }
    }else{ 
        $statusMsg = 'Désolé, seule les fichiers JPG, JPEG, PNG, & GIF sont autorisés.'; 
    } 
}else{ 
    $statusMsg = 'Veuillez selectionner une image'; 
}
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="laReussite.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <title>Formulaire</title>

</head>
<header>
<button type="button" class="btn btn-primary"><a href="../pages/paramétrage.php" style="color:white">Retour</a></button>
  <p><?= $_GET['mess'] ?? null ?></p>
</header>
<body>
  <div class="container my-5">

    <form action="" class="d-flex justify-content-center border p-2 needs-validation bg-light shadow" novalidate  method="post" enctype="multipart/form-data">

                <input type="file"  id="inputGroupFile02" class="form-control w-100 m-3" name="image" required>
                    <br>
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Choisir une photo</div>
                    &nbsp;
                <button type="submit" id="photo" name="submit" class="btn btn-outline-primary col-md-1.5" title="changer">envoyer</button>
                <span class="d-flex border m-1 p-3 btn btn-outline">
                </span>
            </form>



</body>

</html>