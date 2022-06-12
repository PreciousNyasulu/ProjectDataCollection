<?php
require "Connection.php";
session_start();
$username = $_SESSION['User'];

$query = "SELECT * FROM surveyaccounts WHERE Username='$username'";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$id = $row["ID"];

$query = "SELECT * FROM  notifications WHERE (Target=$id OR Target=0) AND Seen=1";
$result = mysqli_query($conn, $query);

$numberOfNotifications = mysqli_num_rows($result);

$data = array(
    'notnum' => $numberOfNotifications
);

echo json_encode($data);
?>