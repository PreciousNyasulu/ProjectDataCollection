<?php
	include ('Connection.php');
	include ('../Connection.php');
    $crime = $_GET['crime'];
function districtpercentage($conn, $District, $crime)
{
	$query = "SELECT * FROM records WHERE Crime='$crime'";
	$results = mysqli_query($conn, $query);
	$NumRecords = mysqli_num_rows($results);

	$query = "SELECT * FROM records WHERE District='$District' AND Crime='$crime'";
	$results = mysqli_query($conn, $query);
	$RecNum = mysqli_num_rows($results);

    if ($NumRecords != 0 || $RecNum != 0) {        
        $percent = $RecNum / $NumRecords * 100;
    }else{
        $percent = 0;
    }	
	return $percent;
}

$dataPoints = array(
	array("label" => "Dedza", "y" => districtpercentage($conn, 'Dedza',$crime)),
	array("label" => "Dowa", "y" => districtpercentage($conn, 'Dowa',$crime)),
	array("label" => "Kasungu", "y" => districtpercentage($conn, 'Kasungu',$crime)),
	array("label" => "Lilongwe", "y" => districtpercentage($conn, 'Lilongwe',$crime)),
	array("label" => "Mchinji", "y" => districtpercentage($conn, 'Mchinji',$crime)),
	array("label" => "Nkhotakhota", "y" => districtpercentage($conn, 'Nkhotakhota',$crime)),
	array("label" => "Ntcheu", "y" => districtpercentage($conn, 'Ntcheu',$crime)),
	array("label" => "Ntchisi", "y" => districtpercentage($conn, 'Ntchisi',$crime)),
	array("label" => "Salima", "y" => districtpercentage($conn, 'Salima',$crime)),
	array("label" => "Chitipa", "y" => districtpercentage($conn, 'Chitipa',$crime)),
	array("label" => "Karonga", "y" => districtpercentage($conn, 'Karonga',$crime)),
	array("label" => "Likoma", "y" => districtpercentage($conn, 'Likoma',$crime)),
	array("label" => "Mzimba", "y" => districtpercentage($conn, 'Mzimba',$crime)),
	array("label" => "Nkhata Bay", "y" => districtpercentage($conn, 'Nkhata Bay',$crime)),
	array("label" => "Rumphi", "y" => districtpercentage($conn, 'Rumphi',$crime)),
	array("label" => "Balaka", "y" => districtpercentage($conn, 'Balaka',$crime)),
	array("label" => "Blantyre", "y" => districtpercentage($conn, 'Blantyre',$crime)),
	array("label" => "Chikhwawa", "y" => districtpercentage($conn, 'Chikwawa',$crime)),
	array("label" => "Chiradzulu", "y" => districtpercentage($conn, 'Chiradzuru',$crime)),
	array("label" => "Machinga", "y" => districtpercentage($conn, 'Machinga',$crime)),
	array("label" => "Mangochi", "y" => districtpercentage($conn, 'Mangochi',$crime)),
	array("label" => "Mwanza", "y" => districtpercentage($conn, 'Mwanza',$crime))
);

?>
<!DOCTYPE HTML>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<script>
		window.onload = function() {

			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				exportEnabled: true,
				theme: "light2",
				title: {
					text: "Crime Distribution in Districts - " + <?php echo json_encode($_GET['crime'],JSON_NUMERIC_CHECK); ?>,
					fontFamily: "Roboto"
				},
				axisY: {
					suffix: "%",
					scaleBreaks: {
						autoCalculate: false
					}
				},
				data: [{
					type: "column",
					yValueFormatString: "#,##0\"%\"",
					indexLabel: "{y}",
					indexLabelPlacement: "inside",
					indexLabelFontColor: "white",
					dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
				}]
			});
			chart.render();

		}
	</script>
	<link rel="stylesheet" href="../Style/analysis.css">
</head>

<body>
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	<script src="../Script/canvasjs/canvasjs.min.js"></script>
	<script src="Script/canvasjs/canvasjs.min.js"></script>
</body>

</html>