<?php
include "Connection.php";

$code = mysqli_real_escape_string($conn,$_POST['Code']);
$error = true;
session_start();
$id  = $_SESSION['id'];
$sql = "SELECT * FROM recoverycode WHERE AccountID=$id AND RecoveryCode=$code";
$results = mysqli_query($conn,$sql);
if (mysqli_num_rows($results) != 0) {
    $error = false;
    $query = "DELETE FROM recoverycode WHERE AccountID=$id";
    mysqli_query($conn,$query);
}else {
    $error = true;
}

$data = array(
    'error' => $error
);
echo json_encode($data);
?>