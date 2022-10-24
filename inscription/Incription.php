<?php include '../connexion_bdd.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
<div class="container">
  <form class="row g-3" id="formul">
  <div class="col-md-6">
    <label for="inputPrenom" class="form-label">Prenom*</label>
    <input type="text" class="form-control" id="Prenom">
    <span id='erreur'></span>
    <span id='ok'></span>
  </div>
  <div class="col-md-6">
    <label for="inputNom" class="form-label">Nom*</label>
    <input type="text" class="form-control" id="Nom">
    <span id='erreur1'></span>
    <span id='ok1'></span>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Adresse mail*</label>
    <input type="text" class="form-control" id="Email" onchange='validmail()'>
    <span id='erreur6'></span>
    <span id='ok2'></span>
  </div>
  <div class="col-md-6">
    <label for="Password" class="form-label">Mot de passe*</label>
    <input type="password" class="form-control" id="Password">
    <span id='erreur3'></span>
    <span id='ok3'></span>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Confirmer le mot de passe*</label>
    <input type="password" class="form-control" id="Confirm_Password">
    <span id='erreur4'></span>
    <span id='ok4'></span>
  </div>
  <div class="col-md-6">
    <label for="inputState" class="form-label">Role</label>
    <select id="role" class="form-select">
      <option selected></option>
      <option>Administrateur</option>
      <option>Utilisateur</option>
    </select>
    <span id='erreur5'></span>
    <span id='ok'></span>
  </div>
 
  <div class="col-md-3">
    <label for="fil" class="foerm-label">photo</label>
    <input type="file" class="form-control" id="file">
    
  </div>

  <div class="col-12">
        <input type="submit" name="submit" id="bouton" class="btn btn-light" value="S'inscrire">
  </div>
  </form>
</div>
<script src="Inscription.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>