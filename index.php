<?php
    require 'LoginSession.php';
    require 'Connection.php';

    if(loggedin()){
        include 'Home.html';
    }
    else{
        include 'Login.html';
    }
?>
