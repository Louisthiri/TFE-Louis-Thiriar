<?php

function checkPassword($pass, $hash){
    if (password_verify($pass, $hash)) {
        return true;
    }
    
    else {
        return false;
    }
}
?>
