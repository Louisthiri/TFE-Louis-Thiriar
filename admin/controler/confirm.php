<?php
session_start();
include('../model/connection.php');

if(isset($_GET['re_email']) && !empty($_GET['re_email'])){
    $email = strip_tags($_GET['re_email']);
    mail($email,"confirmation de la réservation","votre reservation à bien été prise en compte");
   
   
   
   
   $sql = 'UPDATE `reservations`
    SET re_status_ = 2
    WHERE `re_email` = :email;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (emaail)
    $query->bindValue(':email', $email, PDO::PARAM_STR);

    // On exécute la requête
    $query->execute();
    
    header('Location: ../view/logon.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ../view/logon.php');
}





?>