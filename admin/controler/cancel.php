<?php
// On démarre une session
session_start();
include('../model/connection.php');
// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['re_id']) && !empty($_GET['re_id'])){

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['re_id']);

    $sql = 'SELECT * FROM `reservations` WHERE `re_id` = :id;';

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

    
$sql = 'UPDATE `reservations`
SET re_status_ = 3
WHERE `re_id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Produit supprimé";
    //header('Location: ../view/logon.php');
    $email = strip_tags($_GET['re_email']);
    mail($email,"annulation de la réservation","votre reservation à été annulée. N'hésitez pas à reprendre une réservation si besoin.");
   
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ../view/logon.php');
}
