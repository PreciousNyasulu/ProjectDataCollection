<?php
ob_start();
session_start();

function loggedin(){
    if(isset($_SESSION['User']) && !empty($_SESSION['User'])){
        return true;
    }else{
        return false;
    }
}
?>