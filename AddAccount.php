<?php
include "Connection.php";

$error = false;
$emailerror = false;
$username = $_POST['username'];
$email = $_POST['email'];
$DOB = $_POST['DOB'];
$Location = $_POST['location'];
$Sex = $_POST['sex'];
$Occupation = $_POST['occupation'];
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);

function checkPassword_username($user, $pass, $con)
{
    $Usernamequery = "SELECT * FROM surveyaccounts WHERE Username='$user'";
    $passwordquery = "SELECT * FROM surveyaccounts WHERE Username='$pass'";

    $usernameresult = mysqli_query($con, $Usernamequery);
    $passwordresult = mysqli_query($con, $passwordquery);

    if (mysqli_num_rows($passwordresult) != 0 || mysqli_num_rows($usernameresult) != 0) {
        return true;
    } else {
        return false;
    }
}

function checkEmail($user, $Email, $con)
{
    $query = "SELECT * FROM surveyaccounts WHERE Email='$Email'";


    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        return true;
    } else {
        return false;
    }
}

if (checkPassword_username($username, $password, $conn) == false) {
    if (checkEmail($username, $email, $conn)) {
        $sql = "
        INSERT INTO `surveyaccounts` (
            `ID`,
            `Username`,
            `Email`,
            `Password`,
            `DOB`,
            `Sex`,
            `Location`,
            `Occupation`) 
        VALUES (
            NULL,
            '$username', 
            '$email', 
            '$password', 
            '$DOB', 
            '$Sex', 
            '$Location', 
            '$Occupation')
        ";
        if (mysqli_query($conn, $sql)) {
            $error = true;
        } else {
            $error = false;
        }
    }else{
        $emailerror = true;
    }
} else {
    $error = false;
}

$data = array(
    'error' => $error,
    'email' => $emailerror
);
$error = "";
echo json_encode($data);
