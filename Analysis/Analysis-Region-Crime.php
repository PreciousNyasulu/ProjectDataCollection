<?php

	include ('Connection.php');
	include ('../Connection.php');
    $crime = $_GET['crime'];
    

$query = "SELECT * FROM records WHERE Crime='$crime'";
$results = mysqli_query($conn,$query);
$NumOfRecords = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE (District='Dedza' OR District='Dowa' OR District='Kasungu' OR District='Lilongwe' OR District='Mchinji' OR District='Nkhotakhota' OR District='Ntcheu' OR District='Ntchisi' OR District='Salima') AND Crime='$crime'";
$results = mysqli_query($conn,$query);
$Centralregion = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE (District='Chitipa' OR District='Karonga' OR District='Likoma' OR District='Mzimba' OR District='Nkhata Bay' OR District='Rumphi') AND Crime='$crime' ";
$results = mysqli_query($conn,$query);
$Northernregion = mysqli_num_rows($results);

$query = "SELECT * FROM records WHERE (District='Balaka' OR District='Blantyre' OR District='Chikhwawa' OR District='Chiradzulu' OR District='Machinga' OR District='Mangochi' OR District='Mulanje' OR District='Mwanza' OR District='Nsanje' OR District='Thyolo' OR District='Phalombe' OR District='Zomba' OR District='Neno') AND Crime='$crime'";
$results = mysqli_query($conn,$query);
$Southernregion = mysqli_num_rows($results);

function checkresults($region,$Numrec){
    if ($region != 0 || $Numrec !=0) {
        return $region/$Numrec * 100;
    }else {
        return 0;
    }
}

$dataPoints1 = array(
	array("label"=> "Central Region", "y"=>  checkresults($Centralregion,$NumOfRecords)),
	array("label"=> "Northern Region", "y"=> checkresults($Northernregion, $NumOfRecords)),
    array("label"=> "Southern Region", "y"=> checkresults($Southernregion, $NumOfRecords))
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
		text: "Crime Distribution In Regions - " + <?php echo json_encode($crime,JSON_NUMERIC_CHECK); ?>,
        fontFamily: "Roboto"
	},
	subtitles: [{
		text: "Central, Northern & Southern Region",
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