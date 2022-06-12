<?php
require 'LoginSession.php';

session_destroy();
header('Location: Login.html');
?>
