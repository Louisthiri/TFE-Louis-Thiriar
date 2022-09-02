<?php
 session_start();
include('../model/connection.php');
if ($_SESSION["logon"] != true )  {
  header("location: login.php");
}
if($_POST){
    if(isset($_POST['dateDebut']) && !empty($_POST['dateDebut'])
    && isset($_POST['heureDebut']) && !empty($_POST['heureDebut'])
    && isset($_POST['heureFin']) && !empty($_POST['heureFin'])
    && isset($_POST['limiteReservation']) && !empty($_POST['limiteReservation'])){
        

        // On nettoie les données envoyées
        $dateDebut = strip_tags($_POST['dateDebut']);
        $heureDebut = strip_tags($_POST['heureDebut']);
        $heureFin = strip_tags($_POST['heureFin']);
        $limiteReservation = strip_tags($_POST['limiteReservation']);

        $sql = 'INSERT INTO `crenaux` (`cr_date`, `cr_heure_debut`, `cr_heure_fin`, `cr_limite_reservation`) VALUES (:dateDebut, :heureDebut, :heureFin, :limiteReservation);';

        $query = $db->prepare($sql);

        $query->bindValue(':dateDebut', $dateDebut, PDO::PARAM_STR);
        $query->bindValue(':heureDebut', $heureDebut, PDO::PARAM_STR);
        $query->bindValue(':heureFin', $heureFin, PDO::PARAM_STR);
        $query->bindValue(':limiteReservation', $limiteReservation, PDO::PARAM_INT);


        $query->execute();

       

    }else{
        
      
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all"/>
  </head>
<body>
<div class="menu">
<a href="../controler/disconnect.php" class="btn btn-primary">se déconnecter</a>
    <a href="crenaux.php" class="btn btn-primary">ajouter des créneaux</a>
    <a href="../view/logon.php" class="btn btn-primary">gerer les réservations</a>
</div>
    <main class="container">
        <div class="row">
        <!-- <form class="crenaux" method="post">
    <h4 style="margin-bottom: 2em;text-align:center;">Crénaux libres</h4>
    <div class="col-auto">
        <label class=" col-form-label"   for="dateDebut">date:</label>
        <input type="date" class="form-control" id="dateDebut" name="dateDebut"><br><br>
        </div>
        <div class="col-auto">
    <label for="heureDebut">heure de debut :</label>
    <input type="time" class="form-control" id="heureDebut" name="heureDebut"><br><br>
    </div>
    <div class="col-auto">
    <label class=" col-form-label" for="heureFin">heure de fin :</label>
    <input type="time" class="form-control" id="heureFin" name="heureFin"><br><br>
    </div>
    <div class="col-auto">
    <label for="limiteReservation" class="col-form-label">limite de personnes pouvant participer :</label>
    <input type="number"  class="form-control" stly="width:30%;"id="limiteReservation" name="limiteReservation"><br><br>
</div>
    <button class="btn btn-primary" >Envoyer</button>
</form> -->
  
<div class="formulaireCrenaux">
<h1>Ajouter un crenaux</h1> 
    <form  method="POST" id="form-contact" class="form-contact form-validate">
										<fieldset>
											<div class="mb-20">
												<label for="dateDebut" id="formCrenaux"class="label-control">Date :</label>
												<input type="date" id="dateDebut" class="form-control" name="dateDebut" required />
											</div>
											<div class="mb-20">
												<label for="heureDebut" id="formCrenaux" class="label-control">Heure de debut :</label>
												<input type="time"  id="heureDebut" name="heureDebut" class="form-control"  required />
											</div>
											<div class="mb-20">
												<label for="heureFin" id="formCrenaux" class="label-control">heure de fin :</label>
												<input type="time"  id="heureFin" name="heureFin" class="form-control"  required />
											</div>
											<div class="mb-20">
												<label  for="limiteReservation" id="formCrenaux" class="label-control">Limite de personnes pouvant participer :</label>
												<input  type="number" id="limiteReservation" name="limiteReservation"class="form-control" required/>
											</div>
											<div class="mb-20 text-right">
                        <br><br>
												<input type="submit" class="btn btn-primary" value="Envoyer !" />
											</div>
											
										</fieldset>
									</form> 
      </div>
<!-- <form class="form" method="post"style="background:#BAE6FF;">
  <h2>nouveau crénaux</h2>
  <label class=" col-form-label"   for="dateDebut">date:</label>
  <input type="date" id="dateDebut" name="dateDebut" ></input></p>
  <label for="heureDebut">heure de debut :</label>
  <input type="time"  id="heureDebut" name="heureDebut"></input>
  <label class=" col-form-label" for="heureFin">heure de fin :</label>
  <input type="time"  id="heureFin" name="heureFin"></input> 
  <label for="limiteReservation" class="col-form-label">limite de personnes pouvant participer :</label>
  <input type="number" id="limiteReservation" name="limiteReservation">
  <button>Envoyer</button>
  <div class="divRDV">
  </div>
</form> -->

<!-- <form class="row g-3">
<h4 style="margin-bottom: 2em;text-align:center;">Crénaux libres</h4>
  <div class="col-md-6">
  <label for="dateDebut"class="form-label">date de debut:</label>
        <input type="datetime-local" id="dateDebut" name="dateDebut">
  </div>
  <div class="col-md-6">
  <label for="heureDebut">date de fin :</label>
    <input type="datetime-local" id="heureDebut" name="heureDebut">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="col-md-6">
  <label for="limiteReservation">limite de personnes pouvant participer :</label>
    <input type="number" id="limiteReservation" name="limiteReservation">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select">
      <option selected>Choose...</option>
      <option>...</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" class="form-control" id="inputZip">
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
 
</form> -->
    
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Liste des crénaux</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>date </th>
                        <th>heure de debut </th>
                        <th>heure de fin </th>
                        <th>limite de gens</th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM `crenaux` ;';

                        // On prépare la requête
                        $query = $db->prepare($sql);
                        
                        // On exécute la requête
                        $query->execute();
                        
                        // On stocke le résultat dans un tableau associatif
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                                <td><?= $produit['cr_id'] ?></td>
                                <td><?= $produit['cr_date'] ?></td>
                                <td><?= $produit['cr_heure_debut'] ?></td>
                                <td><?= $produit['cr_heure_fin'] ?></td>
                                <td><?= $produit['cr_limite_reservation'] ?></td>
                                
                                <td>
                                 <a href="../controler/delete.php?cr_id=<?= $produit['cr_id']?>">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                
            </section>
        </div>
    </main> 
    <?php
    include('include/footer.php');
?>
<style>
    .crenaux{
        display:flex;
        flex-direction: column;
        justify-content:center;
        align-items:center;  
            
        
    }
    
    .espace{
        margin :5em;
    }

</style>