<?php
    session_start();

    include('../model/read.php');
    include('../model/function.php');

    $login = $_POST['login'];
    $passw = $_POST['pass'];

    $path = 'login.php';
    unset($_POST);

    if(filter_var($login, FILTER_VALIDATE_EMAIL)){
        $email = $login;
        $userinfo = takeAllInfo($email);

        if(!isset($userinfo)){
            $error[] = "vous n'etes pas inscrit, Inscrivez vous !";
            $_SESSION['error'] = $error;
            $path = 'register.php';
            goto end;
        }

        $hashpass = $userinfo['User_Password'];
        if(!checkPassword($passw, $hashpass)){
            $error[] = "Mauvaises références";
            $_SESSION['error'] = $error;
            $path = 'login.php';
            goto end;
        }else{
            unset($_SESSION['error']);
            unset($error);
            $_SESSION['logon'] = true;
            $path = "logon.php";
            goto end;
        }
    }else{
        $userinfo = takeAllInfoLogin($login);

        $hashpass = $userinfo['User_Password'];
        if(!checkPassword($passw, $hashpass)){
            $error[] = "Mauvaises références";
            $_SESSION['error'] = $error;
            $path = 'login.php';
            goto end;
        }else{
            $_SESSION['logon'] = true;
            $path = "logon.php";
            goto end;
        }
    }

    end:
    header("Location: ../view/$path");
?>