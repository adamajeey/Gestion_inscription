<?php session_start();?>
<?php include '../connexion_bdd.php';
if ($_SESSION['id_utilisateurs']) {
  $idSession=$_SESSION['id_utilisateurs'];
}

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css%22%3E">
  <title>User</title>
</head> 
<body>
<h1><?php echo $data['role_utilisateurs']?></h1>
  <!-- Recupèration de la photo à la base de données -->
  <?php
          $state = $conn->prepare("SELECT photo FROM images WHERE user=?");
          $state->execute([$_SESSION['id_utilisateurs']]);
          $rows = $state->fetch(PDO::FETCH_ASSOC);
          ?>
           
<div style="display: flex; flex-direction:column;" >
  <div class="d-grid gap-2 d-md-flex justify-content-md-end espace" >
    <h2 style="color: rgba(2, 117, 216, 1); text-align:center; font-size:50px; height:5px"><?php echo $data['prenom_utilisateurs']. " " .$data['nom_utilisateurs']?></h2>
  <div  style="height:37px; margin-left:30%; display:flex">
  <form action="" method="">
      <input name="search" type="search"style="width: 70%; height:36px" placeholder="Recherche"  />
      <button type="submit" class="btn btn-primary">Recherche</button>
    </form>
  </div>
      <a href="../index.php"><button class="btn btn-primary" type="button">Deconnexion</button></a> 
  </div>
  <div style="display: flex; flex-direction:column;">
        <img src="data:images/jpg;charset=utf8;base64,<?php echo base64_encode($rows['photo']); ?>" class="rounded-circle border p-1 bg-secondary " height="100" width="100" />
        <a href="traitementPhoto.php">Changer la photo</a>
        <p style="color: rgba(2, 117, 216, 1); font-size:25px; height:5px; margin-left:15px;"><?php echo $data['matricule_utilisateurs'];?></p>
  </div>
 </div>
<div class="container">
  <div  class="modif">
  <p><?=$_GET['modif'] ?? null?></p>
</div>
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
    //Pagination
    include("../connexion_bdd.php");
    //on determine sur quelle page on se trouve
    if (isset($_GET['page']) && !empty($_GET['page'])) {
      $pageactuelle = (int) strip_tags($_GET['page']);
    } else {
      $pageactuelle = 1;
    }
    //Pour connaitre le nombre utilisateurs dans notre page
    $list = $conn->prepare("SELECT count(*) AS nbre_user FROM utilisateurs WHERE etat_utilisateurs=0");
    $list->execute();
    $resultat = $list->fetch();
    //recuperation nombre utilisateurs
    $nbresuser = (int)$resultat['nbre_user'];
    $mapage = 5; // on determine le nombre d'utilisateurs par page
    // calcule le nombre tolal de page
    $pages = ceil($nbresuser / $mapage); 
    //
    $first = ($pageactuelle * $mapage) - $mapage;
    $id = $data['id_utilisateurs'];
    $list = $conn->prepare("SELECT * FROM utilisateurs WHERE etat_utilisateurs=0  AND id_utilisateurs!=$id ORDER BY matricule_utilisateurs desc LIMIT $first,$mapage");
    $list->execute(); 

    //Script recherche
    if ((isset($_GET['search'])) && !empty($_GET['search'])){
      $search = $_GET['search'];
      $sql = "SELECT * from utilisateurs WHERE etat_utilisateurs = 0  AND prenom_utilisateurs lIKE '%$search%' OR nom_utilisateurs LIKE '%$search%' AND id_utilisateurs!=$id LIMIT 10";
      $list = $conn->prepare($sql);
      $list->execute();
      
  }
    while ($row = $list->fetch(PDO::FETCH_ASSOC)) {

    
      $prenom = $row['prenom_utilisateurs'];
      $nom = $row['nom_utilisateurs'];       
      $email = $row['email_utilisateurs']; 
      $etat = $row['etat_utilisateurs']; 
      $matricule = $row['matricule_utilisateurs'];
      $role = $row['role_utilisateurs'];
      $id = $row['id_utilisateurs'];

      echo '<tr>
      <th>'.$prenom .'</th>
      <td>'.$nom .'</td>
      <td>'.$email .'</td>
      <td>'.$matricule.'</td>
      <td>'.$role .'</td>
      <td>
 
      </tr>';
    }
    
    ?>
    </tbody>
    </table>

</div>  <br>
<nav aria-label="Page navigation example" style="margin-left:810px;">
   <ul class="pagination">
     <li class="page-item <?= ($pageactuelle == 1) ? "disabled" : "" ?>">
       <a class="page-link" href="?page=<?= $pageactuelle - 1 ?>" aria-label="Previous">
         <span aria-hidden="true">&laquo;</span>
       </a>
     </li>
     <?php
     for ($page = 1; $page <= $pages; $page++) : ?>
       <li class="page-item <?= ($pageactuelle == $page) ? "active" : "" ?> ">
         <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
       </li>
     <?php endfor ?>
     <li class="page-item  <?= ($pageactuelle == $pages) ? "disabled" : "" ?> ">
       <a class="page-link" href="?page=<?= $pageactuelle + 1 ?>" aria-label="Next">
         <span aria-hidden="true">&raquo;</span>
       </a>
     </li>
   </ul>
 </nav>
</body>
</html>