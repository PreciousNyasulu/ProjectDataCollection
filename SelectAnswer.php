<?php
include "Connection.php";

session_start();
$User = $_SESSION['User'];
$question = $_POST['Question'];
$answer = $_POST['Answer'];
$error = false;

// getting the user ID
$query = "SELECT * FROM surveyaccounts WHERE Username='$User'";
$results = mysqli_query($conn, $query);

if (mysqli_num_rows($results) != 0) {
    $rows = mysqli_fetch_assoc($results);
    $UserID = $rows['ID'];
} else {
    $error = true;
}

// getting the question ID
$query = "SELECT * FROM polls WHERE Question='$question'";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) != 0) {
    $rows = mysqli_fetch_assoc($results);
    $questionID = $rows['ID'];
} else {
    $error = true;
}

// getting the answer ID
$query = "SELECT * FROM pollanswers WHERE Answer='$answer'";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) != 0) {
    $rows = mysqli_fetch_assoc($results);
    $AnswerID = $rows['ID'];
} else {
    $error = true;
}

// checking if user has answered the question before
$query = "SELECT * FROM useranswers WHERE UserID=$UserID AND PollID=$questionID";
$results = mysqli_query($conn, $query);
if (mysqli_num_rows($results) != 0) {
    $query = "UPDATE useranswers SET AnswerID=$AnswerID WHERE UserID=$UserID AND PollID=$questionID";
    mysqli_query($conn, $query);
} else {
    $query = "INSERT INTO useranswers(UserID,PollID,AnswerID) VALUES($UserID,$questionID,$AnswerID)";
    mysqli_query($conn, $query);
}

$data = array(
    'error' => $error
);

echo json_encode($data);
