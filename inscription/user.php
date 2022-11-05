<?php session_start();?>

<?php include '../connexion_bdd.php';

//Recuperation des donnees de l'utilisateurs 
$req = $conn->prepare("SELECT * FROM utilisateurs WHERE id_utilisateurs = ?");
$req->execute(array($_SESSION['id_utilisateurs']));
$data = $req ->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="users.css">
  <title>User</title>
</head>
<body>
  <h1>Espace utilisateurs</h1>

<p style="color: rgba(2, 117, 216, 1); font-size:25px; height:5px"><?php echo $data['matricule_utilisateurs'];?></p>
<div class="d-grid gap-2 d-md-flex justify-content-md-end espace" >
  <h2 style="color: rgba(2, 117, 216, 1); text-align:center; font-size:50px; height:5px"><?php echo $data['prenom_utilisateurs']. " " .$data['nom_utilisateurs']?></h2>
 <div  style="height:37px; margin-left:30%; display:flex">
 <form action="" method="">
    <input name="search" type="search"style="width: 70%; height:36px" placeholder="Recherche"  />
    <button type="submit" class="btn btn-primary">Recherche</button>
  </form>
</div>

  <div class="bouton" style="margin-left: 85%;">
    <a href="../index.php"><button type="button" class="btn btn-primary btn-lg">Deconnexion</button></a> 
    <a href="archive.php"><button type="button" class="btn btn-primary btn-lg">Archivés</button></a> 
  </div>
<div class="container">
 <table class="table">
  <thead>
    <tr>
      <th scope="col">Prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">matricule</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $recup = $conn->prepare('SELECT * FROM utilisateurs');
    $recup->execute();

    while ($row = $recup->fetch(PDO::FETCH_ASSOC)) {
    
      $prenom = $row['prenom_utilisateurs'];
      $nom = $row['nom_utilisateurs'];       
      $email = $row['email_utilisateurs']; 
      $matricule =  $row['matricule_utilisateurs'];
      $role = $row['role_utilisateurs'];
      $_id = $row['id_utilisateurs'];

      echo '<tr>
      <td>'.$prenom .'</td>
      <td>'.$nom .'</td>
      <td>'.$email .'</td>
      <td>'.$matricule .'</td>
      <td>'.$role .'</td>
      </tr>';
      
    }
    
    ?>
    </tbody>
    </table>
</div>
</body>
</html>