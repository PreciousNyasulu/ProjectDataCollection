<?php
include 'Connection.php';
$index = $_POST['DBindex'];
$navigation = $_POST['next'];
$found = false;
$Question;

if ($navigation = true) {
    $query = "SELECT * FROM polls WHERE ID=(SELECT Max(ID) FROM polls)-$index";
    $results = mysqli_query($conn, $query);
}else {
    $query = "SELECT * FROM polls WHERE ID=(SELECT Max(ID) FROM polls)+$index";
    $results = mysqli_query($conn, $query);
}

$row = mysqli_fetch_assoc($results);
if (mysqli_num_rows($results) != 0) {
    $found = true;
    $Question = $row['Question'];
    $QuestionID = $row['ID'];
    $query = "SELECT * FROM pollanswers WHERE PollID=$QuestionID";
    $results = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($results);
    $option1 = $row['Answer'];
    $row = mysqli_fetch_assoc($results);
    $option2 = $row['Answer'];
    $row = mysqli_fetch_assoc($results);
    $option3 = $row['Answer'];
} else {
    $found = false;
}

$data = array(
    'found' => $found,
    'Question' => $Question,
    'option1' => $option1,
    'option2' => $option2,
    'option3' => $option3
);

echo json_encode($data);
