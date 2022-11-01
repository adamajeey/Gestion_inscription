<?php include '../connexion_bdd.php';

if (isset($_GET['id_utilisateurs'])) {
  $id=$_GET['id_utilisateurs'];
  $datearch=date('y-m-d');
  $req=$conn->prepare("UPDATE utilisateurs SET etat_utilisateurs ='1', date_archivage_utilisateurs='$datearch' where id_utilisateurs='$id'");
  $req->execute();
  if ($req) {
    header('location:admin.php?delete=Archivé avec succes!');
 }else{
    die('Erreur :' .$e->message());
}
}

?>