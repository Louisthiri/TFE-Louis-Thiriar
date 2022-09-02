<?php
        session_start();

        if ($_SESSION["logon"] != true )  {
         header("location: login.php");
}

include('../model/connection.php');
include('include/header.php');

$sql = 'DELETE FROM `reservations`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
header("location: ../view/logon.php");
?>