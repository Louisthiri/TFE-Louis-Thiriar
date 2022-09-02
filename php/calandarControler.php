<?php
include('admin/model/connection.php');



if($_POST){
    if(isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['tel']) && !empty($_POST['tel'])
    && isset($_POST['creneau']) && !empty($_POST['creneau'])){

        
        
        // On nettoie les données envoyées
        $prenom = htmlspecialchars(addslashes(htmlentities(strip_tags($_POST['prenom']))));
        $nom = htmlspecialchars(addslashes(htmlentities(strip_tags($_POST['nom']))));
        $email = htmlspecialchars(addslashes(htmlentities(strip_tags($_POST['email']))));
        $tel = htmlspecialchars(addslashes(htmlentities(strip_tags($_POST['tel']))));
        $creneau = htmlspecialchars(addslashes(htmlentities(strip_tags($_POST['creneau']))));
        
        mail($email,"Réservation en cours", "votre réservation est en cours de confirmation veuillez attendre que Victoria valide
        votre réservation. Vous recevrez un email pour vous tenir au courant !");

        $sql = 'INSERT INTO `reservations` (`re_prenom`, `re_nom`, `re_email`, `re_tel`, `re_crenaux_id`) VALUES (:prenom, :nom, :email, :tel, :creneau);';

        $query = $db->prepare($sql);

        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        $query->bindValue(':creneau', $creneau, PDO::PARAM_INT);

        $query->execute();


    }else{
      
    }
}



?>