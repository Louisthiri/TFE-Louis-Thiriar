<?php
 session_start();
 include('../model/connection.php');
//recuperer les crenaux horraires par rapport à une date et afficher si il y a une limite

if(isset($_POST['dateCrenaux']) && is_numeric($_POST['dateCrenaux']) && $_POST['dateCrenaux']>0){

    $dispos = array();
                        
    $dateCrenaux = strip_tags(date('Y/m/d',$_POST['dateCrenaux']));
    
    $sql = 'SELECT * FROM `crenaux` WHERE `cr_date`="' . $dateCrenaux . '"';
    
    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute la requête
    $query->execute();
    
    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    // On boucle sur la variable result
    
    foreach($result as $produit){
        
        // Vérifier si le créneaux est disponbile
        $sql = 'SELECT COUNT(*) as nbr FROM `reservations` WHERE `re_crenaux_id`="' . $produit['cr_id'] . '" AND re_status_ != 3';
        $query = $db->prepare($sql);
        $query->execute();
        $result2 = $query->fetch(PDO::FETCH_ASSOC);

        // Si le nombre de reservation est inférieur à la limite, c'est que le créneau est disponible
        if($result2['nbr'] < $produit['cr_limite_reservation']){

            $creneau_array = array();

            $heure_debut = date('H\hi', strtotime($produit['cr_date'] . ' ' . $produit['cr_heure_debut']));
            $heure_fin = date('H\hi', strtotime($produit['cr_date'] . ' ' . $produit['cr_heure_fin']));

            array_push($creneau_array,$produit['cr_id'],$produit['cr_date'],$heure_debut,$heure_fin);
            array_push($dispos,$creneau_array);
        }
    }
    echo json_encode($dispos);
}
?>
        