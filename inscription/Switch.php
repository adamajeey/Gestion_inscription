
<?php include '../connexion_bdd.php';?>

<?php 
    $id = $_GET['id_utilisateurs'];
    $sql = "SELECT * from utilisateurs WHERE etat_utilisateurs = 0  AND id_utilisateurs = $id";
    $select = $conn->prepare($sql);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['role_utilisateurs'] == 'administrateur') {
            $req_sql = "UPDATE utilisateurs SET `role_utilisateurs` = 'utilisateur' WHERE id_utilisateurs = $id ";
            $req = $conn->prepare($req_sql);
            $req->execute();
            header('location:admin.php');
        }
        else  {
            $req_sql = "UPDATE utilisateurs SET `role_utilisateurs` = 'administrateur' WHERE id_utilisateurs = $id ";
            $req = $conn->prepare($req_sql);
            $req->execute();
            header('location:admin.php');
        }
    ?>
