<?php
include "Connection.php";

$noExistence = false;
$locked = false;
$wrongpass = false;
$success = false;
$attempts =0;
$ID = '';

// this function adds number of wrong attemps
function addStrike($accountID,$connection){
    $mydate = date("Y-m-d H:i:s");

    $sql1 = "SELECT * FROM accountlockinfo
        WHERE AccountID=$accountID
    ";
    $result = mysqli_query($connection,$sql1);
    if(mysqli_num_rows($result) != 0 && lockAccount($accountID,$connection)){
        $sql = "UPDATE accountlockinfo SET
            PasswordStrikes=PasswordStrikes+1,LockTime='$mydate'
            WHERE AccountID=$accountID
        ";
        mysqli_query($connection,$sql);
    }else if(mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO accountlockinfo(
            AccountID,
            PasswordStrikes,
            LockTime
            )
            VALUES(
                $accountID,
                1,
                '$mydate'
            )
        ";
        mysqli_query($connection,$sql);
    }else{
        $sql = "UPDATE accountlockinfo SET
            PasswordStrikes=1,LockTime='$mydate'
            WHERE AccountID=$accountID
        ";
        mysqli_query($connection,$sql);
    }

    $getsrikes =  mysqli_query($connection,$sql1);
    if (mysqli_num_rows($getsrikes) !=0) {
        while($row = mysqli_fetch_assoc($getsrikes)){
            return $row['PasswordStrikes'];
        }
    }
}

// this function locks account if 3 strikes are reached
function lockAccount($accountID,$connection){
    $sql = "SELECT * FROM accountlockinfo
        WHERE AccountID=$accountID
    ";
    $result = mysqli_query($connection,$sql);
    
    if(mysqli_num_rows($result) !=0){
        
        while($row = mysqli_fetch_assoc($result)){
            $strikes = $row['PasswordStrikes'];
            if($strikes ==3){
                return false;
            }else{
                return true;
            }
        }
    }else {
            return true;
    }
}

// this function checks if the lockage time has expired
function checkLockTime($accountID,$connection){
    $sql = "SELECT * FROM accountlockinfo
    WHERE AccountID=$accountID AND PasswordStrikes>=3
    ";
    $result = mysqli_query($connection,$sql);
    $mydate ='';
    if (mysqli_num_rows($result) !=0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $mydate=  $row['LockTime'];
            $date = date("Y-m-d H:i:s");
            $datetime1 = date_create($date);
            $datetime2 = date_create($mydate);

            $interval = date_diff($datetime1,$datetime2);
            $min =$interval->format('%i');
            $sec =$interval->format('%s');
            $hour =$interval->format('%h');
            $mon =$interval->format('%m');
            $day =$interval->format('%d');
            $year =$interval->format('%y');

            if($min >= 10){
                return true;
            }else if($hour >0){
                return true;
            }else if($mon >0){
                return true;
            }else if($year >0){
                return true;
            }else{
                return false;
            }
        }
    }else{
        return true;
    }    
}

// this function removes strikes
function removeStrikes($accountID,$connection){
    $sql = "UPDATE accountlockinfo
    SET PasswordStrikes=0
    WHERE AccountID=$accountID
    ";
    mysqli_query($connection,$sql);  
}


    $username = mysqli_real_escape_string($conn,$_POST['Username']);
    $password = mysqli_real_escape_string($conn,$_POST['Password']);

    $sql = "SELECT * FROM surveyaccounts WHERE Username='$username'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) !=0){
        while($row = mysqli_fetch_assoc($result)){
            $dbPassword = $row['Password'];
            $dbaccountID = $row['ID'];
            $session = $row['Username'];
            
            if(password_verify($_POST['Password'], $dbPassword)){
                // removeStrikes($dbaccountID,$conn);
                $ID = $dbaccountID;
                session_start();
                $_SESSION['User'] = $session;
                
                $_SESSION['UserID'] = $row['ID'];
                $success = true;
            }else{
                // $attempts= addStrike($dbaccountID,$conn);
                $wrongpass = true;
            }            
        }
    }else{
        $noExistence = true;
    }


$data = array(
    'locked' => $locked,
    'WrongPassword' => $wrongpass,
    'NoAccount' => $noExistence,
    'Success' => $success,
    'attempts' => $attempts,
    'ID' => $ID
);
echo json_encode($data);
?>