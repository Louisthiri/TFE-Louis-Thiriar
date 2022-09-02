<?php
function takeAllUser(){ //selectionne tout les utilisateurs de la db
    include('connection.php');
    $query = "SELECT * FROM user";

    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
    }

    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function mailExist($email){ //Sert à voir si on a déja utilisé ce mail pour se connecter
   include('connection.php');
   $query = "SELECT User_Email FROM User WHERE User_Email = :email";
   $query_params = array(':email'=>$email);
   try{
       $stmt = $db->prepare($query);
       $result = $stmt->execute($query_params);
   }
   catch(PDOException $ex){
       die("Failed query : " . $ex->getMessage());
   }
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $result[0];
}
function takeAllInfo($email){ //Sert à voir si on a déja utilisé ce mail pour se connecter
    include('connection.php');
    $query = "SELECT * FROM User WHERE User_Email = :email";
    $query_params = array(':email'=>$email);
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[0];
 }
 function takeAllInfoLogin($login){ //Sert à voir si on a déja utilisé ce login pour se connecter
    include('connection.php');
    $query = "SELECT * FROM User WHERE User_Login = :login";
    $query_params = array(':login'=>$login);
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[0];
 }
?>
