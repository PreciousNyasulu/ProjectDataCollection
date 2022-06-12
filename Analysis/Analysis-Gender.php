<?php

	include ('Connection.php');
	include ('../Connection.php');


$query = "SELECT * FROM records";
$results = mysqli_query($conn,$query);
$NumOfRecords = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE Sex='Male'";
$results = mysqli_query($conn,$query);
$NumOfMale = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE Sex='Female'";
$results = mysqli_query($conn,$query);
$NumOfFemale = mysqli_num_rows($results);

$dataPoints1 = array(
	array("label"=> "Male", "y"=>  $NumOfMale / $NumOfRecords * 100),
	array("label"=> "Female", "y"=> $NumOfFemale / $NumOfRecords  * 100)
);
	
?>
<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,	
	exportEnabled: true,
	title:{
		text: "Crime Distribution By Gender",
        fontFamily: "Roboto"
	},
	subtitles: [{
		text: "Male & Female",
        fontFamily: "Roboto"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0\"%\"",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<link rel="stylesheet" href="../Style/analysis.css">
</head>
<body>
<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
<script src="../Script/canvasjs/canvasjs.min.js"></script>
<script src="Script/canvasjs/canvasjs.min.js"></script>
</body>
</html>                              