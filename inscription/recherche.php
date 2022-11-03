<?php
    if (isset($_GET['search'])) {
     if ($_GET['search'] != ""){
        $search = $_GET['search'];
        $sql = "SELECT * from utilisateurs WHERE etat_utilisateurs = 0  AND id_utilisateurs != $id AND matricule_utilisateurs lIKE '%$search%' LIMIT 10";
        $select = $conn->prepare($sql);
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC); 
    }

    }
    else {
        $id = $_SESSION['id_utilisateurs'];
        $sql = "SELECT * from utilisateurs WHERE etat_utilisateurs = 0  AND id_utilisateurs != $id LIMIT 10";
        $select = $conn->prepare($sql);
        $select->execute();
        $row = $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
?>