<?php
include "Connection.php";

//Php mailer requirements
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$Username = mysqli_real_escape_string($conn,$_POST['Username']);
$error = true;

   

    $sql = "SELECT * FROM surveyaccounts WHERE Username='$Username'";
    $result = mysqli_query($conn,$sql);
    $rows =mysqli_fetch_assoc($result);
    $code = rand(000000,999999);
    if(mysqli_num_rows($result) != 0){
        $id = $rows['ID'];
        $email = $rows['Email'];
        $sql2 = "INSERT INTO recoverycode VALUES($id,$code)";
        mysqli_query($conn,$sql2);
        $error= false;
        $message = 'Your recovery code is <b>'.$code.'<b>';

        // sending email to the account
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'malawipolicesurvey@gmail.com';
        $mail->Password = 'pr3c10u5@D';
        $mail->setFrom('no-reply@gmail.com','Malawi Police Survey');
        $mail->Subject ='Password Recovery Code';
        $mail->Body = $message;
        $mail->AddAddress($email);
        $mail->Send();
        
        // creating session
        session_start();
        $_SESSION['id'] = $id;
    }
    else{
        $error = true;
    }



$data = array(
    'error' => $error
);
echo json_encode($data);
?>