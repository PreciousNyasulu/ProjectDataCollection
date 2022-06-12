<?php

	include ('Connection.php');
	include ('../Connection.php');


$query = "SELECT * FROM records";
$results = mysqli_query($conn,$query);
$NumOfRecords = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE District='Dedza' OR District='Dowa' OR District='Kasungu' OR District='Lilongwe' OR District='Mchinji' OR District='Nkhotakhota' OR District='Ntcheu' OR District='Ntchisi' OR District='Salima'";
$results = mysqli_query($conn,$query);
$Centralregion = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE District='Chitipa' OR District='Karonga' OR District='Likoma' OR District='Mzimba' OR District='Nkhata Bay' OR District='Rumphi'";
$results = mysqli_query($conn,$query);
$Northernregion = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE District='Balaka' OR District='Blantyre' OR District='Chikhwawa' OR District='Chiradzulu' OR District='Machinga' OR District='Mangochi' OR District='Mulanje' OR District='Mwanza' OR District='Nsanje' OR District='Thyolo' OR District='Phalombe' OR District='Zomba' OR District='Neno'";
$results = mysqli_query($conn,$query);
$Southernregion = mysqli_num_rows($results);

$dataPoints1 = array(
	array("label"=> "Central Region", "y"=>  $Centralregion / $NumOfRecords * 100),
	array("label"=> "Northern Region", "y"=> $Northernregion / $NumOfRecords  * 100),
    array("label"=> "Southern Region", "y"=> $Southernregion / $NumOfRecords  * 100)
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
		text: "Crime Distribution In Regions",
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