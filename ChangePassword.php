<?php
include "Connection.php";

$error = true;
$diffpassword = false;
$newpassword = mysqli_real_escape_string($conn,$_POST['Password']);
$encryptedpassword = password_hash($newpassword,PASSWORD_BCRYPT);
session_start();
$id = $_SESSION['id'];

$sql = "SELECT * FROM surveyaccounts WHERE ID=$id";
$results = mysqli_query($conn,$sql);
$rows = mysqli_fetch_assoc($results);

if (password_verify($newpassword, $rows['Password'])) {
    $diffpassword = true;
}else {
    $sql = "UPDATE surveyaccounts SET Password='$encryptedpassword' WHERE ID=$id";
    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM recoverycode WHERE AccountID=$id";
        if (mysqli_query($conn,$sql)) {
            $error = false;
        }
    }else {
        $error == true;
    }
}



$data =  array(
    'error' => $error,
    'diffpassword'=> $diffpassword
);
echo json_encode($data);

session_destroy();
?>