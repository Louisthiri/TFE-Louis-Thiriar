<?php
// On démarre une session
session_start();
include('../model/connection.php');
// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['cr_id']) && !empty($_GET['cr_id'])){

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['cr_id']);

    $sql = 'SELECT * FROM `crenaux` WHERE `cr_id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ../view/logon.php');
        die();
    }

    
$sql = 'DELETE FROM `crenaux`
WHERE `cr_id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Produit supprimé";
    header('Location: ../view/crenaux.php');
   
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ../view/crenaux.php');
}
