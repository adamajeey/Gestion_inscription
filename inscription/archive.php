<?php include '../connexion_bdd.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3' crossorigin='anonymous'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>
    <link rel="stylesheet" href="archive.css">
    <title>Archive</title>
</head>
<body>
  <h1>Liste des archives</h1>
<div class="container">
<table class="table">
  <thead>
    <tr class="pass">
      <th scope="col">Prenom</th> 
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">matricule</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th> 
    </tr>
  </thead>
  </div>
</body>

<?php

$req = $conn->prepare(('SELECT * FROM utilisateurs WHERE etat_utilisateurs = 1'));
$req->execute();

while ($row=$req->fetch(PDO::FETCH_ASSOC)) {
  $id=$row['id_utilisateurs'];
  $prenom=$row['prenom_utilisateurs'];
  $nom=$row['nom_utilisateurs'];
  $email=$row['email_utilisateurs'];
  $matricule=$row['matricule_utilisateurs'];
  $etat=$row['etat_utilisateurs'];
  $role=$row['role_utilisateurs'];
  $datearch=$row['date_archivage_utilisateurs'];

  echo '<tr>

      <th>'.$prenom.'</th>
      <td>'.$nom.'</td>
      <td>'.$email.'</td>
      <td>'.$matricule.'</td>
      <td>'.$role .'</td>
      <td>
        <a href="desarchive.php?id_ut='.$id.'"><i class="bi bi-pencil-square"></i><svg width="30" height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><svg width="40" height="40" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 42C8.2 42 7.5 41.7 6.9 41.1C6.3 40.5 6 39.8 6 39V12.85C6 12.35 6.05 11.925 6.15 11.575C6.25 11.225 6.43333 10.9 6.7 10.6L9.5 6.8C9.76667 6.5 10.075 6.29167 10.425 6.175C10.775 6.05833 11.1833 6 11.65 6H36.35C36.8167 6 37.2167 6.05833 37.55 6.175C37.8833 6.29167 38.1833 6.5 38.45 6.8L41.3 10.6C41.5667 10.9 41.75 11.225 41.85 11.575C41.95 11.925 42 12.35 42 12.85V39C42 39.8 41.7 40.5 41.1 41.1C40.5 41.7 39.8 42 39 42H9ZM9.85 11.3H38.1L36.3 9H11.65L9.85 11.3ZM9 14.3V39H39V14.3H9ZM22.5 34.5H25.5V24.45L29.8 28.75L31.8 26.75L24 18.95L16.2 26.75L18.2 28.75L22.5 24.45V34.5ZM9 39H39H9Z" fill="white"/>
        </svg>
      </td>
      </tr>';

}

?>

</html>