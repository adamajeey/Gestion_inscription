<?php include '../connexion_bdd.php';

if (isset($_GET['id_ut'])) {
  $id=$_GET['id_ut'];
  $datearch=date('y-m-d');
  $req=$conn->prepare("UPDATE utilisateurs SET etat_utilisateurs ='0', date_archivage_utilisateurs='$datearch' where id_utilisateurs='$id'");
  $req->execute();
  if ($req) {  header('location:archive.php?delete=deArchivé avec succes!');
}else{
    die('Erreur :' .$e->message());
}
}
?>