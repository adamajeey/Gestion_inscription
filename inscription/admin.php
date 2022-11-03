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
  <link rel="stylesheet" href="user.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css%22%3E">
  <title>Admin</title>
</head>
<body>
 
  <h1>Espace Administrateur</h1>
  <h2 style="color: rgba(2, 117, 216, 1); text-align:center; font-size:50px"><?php echo $data['prenom_utilisateurs']. " " .$data['nom_utilisateurs']?></h2>
  <div class="d-grid gap-2 d-md-flex justify-content-md-end espace" >
  
    <div  style="height:20px; margin-left:30%">
    <input type="search"style="width: 70%; height:36px" placeholder="recherche" aria-label="Search" aria-describedby="search-addon" />
    <button type="button" class="btn btn-primary">recherche</button>
</div>
    <a href="archive.php"><button class="btn btn-primary me-md-1" type="button">Archivés</button></a> 
    <a href="../index.php"><button class="btn btn-primary" type="button">Deconnexion</button></a> 
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
      <th scope="col">Action</th> 
    </tr>
  </thead>
  <tbody>
  
    <?php
    $recup = $conn->prepare('SELECT * FROM utilisateurs WHERE etat_utilisateurs=0');
    $recup->execute();

    while ($row = $recup->fetch(PDO::FETCH_ASSOC)) {
    
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
          <a href="modifier.php?id_utilisateurs='. $id .'"> <i class="bi bi-pencil-square"></i><svg width="30" height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 48V41.95H44V48H4ZM8.1 36.65V30L26.75 11.35L33.4 18L14.75 36.65H8.1ZM11.1 33.65H13.35L29.1 17.9L26.85 15.65L11.1 31.4V33.65ZM35.6 15.8L28.95 9.15003L33.15 4.95003C33.5167 4.5167 33.9333 4.2917 34.4 4.27503C34.8667 4.25837 35.3333 4.48337 35.8 4.95003L39.7 8.85003C40.1333 9.28337 40.35 9.7417 40.35 10.225C40.35 10.7084 40.1667 11.1667 39.8 11.6L35.6 15.8Z" fill="white"/></a>

     
        <a onclick ="return confirm(\'voulez vous vraiment archiver \')" href="delete.php?id_utilisateurs='.$id.'"><i class="bi bi-pencil-square"></i><svg width="30" height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 42C8.2 42 7.5 41.7 6.9 41.1C6.3 40.5 6 39.8 6 39V12.85C6 12.35 6.05 11.925 6.15 11.575C6.25 11.225 6.43333 10.9 6.7 10.6L9.5 6.8C9.76667 6.5 10.075 6.29167 10.425 6.175C10.775 6.05833 11.1833 6 11.65 6H36.35C36.8167 6 37.2167 6.05833 37.55 6.175C37.8833 6.29167 38.1833 6.5 38.45 6.8L41.3 10.6C41.5667 10.9 41.75 11.225 41.85 11.575C41.95 11.925 42 12.35 42 12.85V39C42 39.8 41.7 40.5 41.1 41.1C40.5 41.7 39.8 42 39 42H9ZM9.85 11.3H38.1L36.3 9H11.65L9.85 11.3ZM9 14.3V39H39V14.3H9ZM24 34.5L31.8 26.7L29.8 24.7L25.5 29V18.95H22.5V29L18.2 24.7L16.2 26.7L24 34.5Z" fill="white"/></a>
    

      <a href="Switch.php?id_utilisateurs='.$id.'"><i class="bi bi-pencil-square"></i><svg width="30" height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M24.1 38L29.8 32.35L24.1 26.7L22 28.8L24.15 30.95C23.2167 30.9833 22.3083 30.8333 21.425 30.5C20.5417 30.1667 19.75 29.65 19.05 28.95C18.3833 28.2833 17.875 27.5167 17.525 26.65C17.175 25.7833 17 24.9167 17 24.05C17 23.4833 17.075 22.9167 17.225 22.35C17.375 21.7833 17.5833 21.2333 17.85 20.7L15.65 18.5C15.0833 19.3333 14.6667 20.2167 14.4 21.15C14.1333 22.0833 14 23.0333 14 24C14 25.2667 14.25 26.5167 14.75 27.75C15.25 28.9833 15.9833 30.0833 16.95 31.05C17.9167 32.0167 19 32.7417 20.2 33.225C21.4 33.7083 22.6333 33.9667 23.9 34L22 35.9L24.1 38ZM32.35 29.5C32.9167 28.6667 33.3333 27.7833 33.6 26.85C33.8667 25.9167 34 24.9667 34 24C34 22.7333 33.7583 21.475 33.275 20.225C32.7917 18.975 32.0667 17.8667 31.1 16.9C30.1333 15.9333 29.0417 15.2167 27.825 14.75C26.6083 14.2833 25.3667 14.05 24.1 14.05L26 12.1L23.9 10L18.2 15.65L23.9 21.3L26 19.2L23.8 17C24.7 17 25.6167 17.175 26.55 17.525C27.4833 17.875 28.2833 18.3833 28.95 19.05C29.6167 19.7167 30.125 20.4833 30.475 21.35C30.825 22.2167 31 23.0833 31 23.95C31 24.5167 30.925 25.0833 30.775 25.65C30.625 26.2167 30.4167 26.7667 30.15 27.3L32.35 29.5ZM24 44C21.2667 44 18.6833 43.475 16.25 42.425C13.8167 41.375 11.6917 39.9417 9.875 38.125C8.05833 36.3083 6.625 34.1833 5.575 31.75C4.525 29.3167 4 26.7333 4 24C4 21.2333 4.525 18.6333 5.575 16.2C6.625 13.7667 8.05833 11.65 9.875 9.85C11.6917 8.05 13.8167 6.625 16.25 5.575C18.6833 4.525 21.2667 4 24 4C26.7667 4 29.3667 4.525 31.8 5.575C34.2333 6.625 36.35 8.05 38.15 9.85C39.95 11.65 41.375 13.7667 42.425 16.2C43.475 18.6333 44 21.2333 44 24C44 26.7333 43.475 29.3167 42.425 31.75C41.375 34.1833 39.95 36.3083 38.15 38.125C36.35 39.9417 34.2333 41.375 31.8 42.425C29.3667 43.475 26.7667 44 24 44ZM24 41C28.7333 41 32.75 39.3417 36.05 36.025C39.35 32.7083 41 28.7 41 24C41 19.2667 39.35 15.25 36.05 11.95C32.75 8.65 28.7333 7 24 7C19.3 7 15.2917 8.65 11.975 11.95C8.65833 15.25 7 19.2667 7 24C7 28.7 8.65833 32.7083 11.975 36.025C15.2917 39.3417 19.3 41 24 41Z" fill="white"/>
      </svg></a>

      </td>
      </tr>';
    }
    
    ?>
    </tbody>
    </table>
</div>
</body>
</html>