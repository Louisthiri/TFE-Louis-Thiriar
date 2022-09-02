<?php //établis la connection avec la db
        
        date_default_timezone_set('Europe/Brussels');
        
        $username = "amplitethiriar";
        $password = "Amplite10";
        $host = "amplitethiriar.mysql.db";
        $dbname = "amplitethiriar";

        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

        try {
            $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
        }
        catch(PDOException $ex){
            die("Failed to connect to the database: " . $ex->getMessage());
        }

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>
