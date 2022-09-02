<?php
        session_start();

        if ($_SESSION["logon"] != true )  {
         header("location: login.php");
}

include('../model/connection.php');
include('include/header.php');

$sql = 'SELECT * FROM `reservations` INNER JOIN `status_` on `re_status_` = `st_id`
INNER JOIN `crenaux` ON `re_crenaux_id` = `cr_id`
ORDER BY `re_id` DESC';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
<div class="menu" style="margin-bottom:5em;">
<a href="../controler/disconnect.php" class="btn btn-primary">se déconnecter</a>
    <a href="crenaux.php" class="btn btn-primary">ajouter des crenaux</a>
    <a href="../view/logon.php" class="btn btn-primary">gerer les réservations</a>
</div>
    <main class="container">
        <div class="row">
            <section class="col-13">
                <h1>Liste des réservations en attente</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>nom</th>
                        <th>Prenom</th>
                        <th>Téléphone</th>
                        <th>email</th>
                        <th>status</th>
                        <th>heure de debut</th>
                        <th>heure de fin</th>
                        <th>date</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $produit){
                        ?>
                            <tr>
                                <td><?= $produit['re_id'] ?></td>
                                <td><?= $produit['re_nom'] ?></td>
                                <td><?= $produit['re_prenom'] ?></td>
                                <td><?= $produit['re_tel'] ?></td>
                                <td><?= $produit['re_email'] ?></td>
                                <td><?= $produit['st_nom'] ?></td>
                                <td><?= $produit['cr_heure_debut'] ?></td>
                                <td><?= $produit['cr_heure_fin'] ?></td>
                                <td><?= $produit['cr_date'] ?></td>

                                <td><a href="../controler/confirm.php?re_email=<?=$produit['re_email'] ?>">Confirmer</a>
                                 <a href="../controler/cancel.php?re_id=<?= $produit['re_id']?>&re_email=<?=$produit['re_email'] ?>">Annuler</a></td>
                            </tr>
                            
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                
            </section>
            <a href="../model/delete.php" class="btn btn-primary">supprimer l'historique</a>
        </div>
    </main>
<?php
include('include/footer.php');
?>