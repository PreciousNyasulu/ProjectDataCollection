<?php
	include ('Connection.php');
	include ('../Connection.php');

function districtpercentage($conn, $District)
{
	$query = "SELECT * FROM records";
	$results = mysqli_query($conn, $query);
	$NumRecords = mysqli_num_rows($results);

	$query = "SELECT * FROM records WHERE District='$District'";
	$results = mysqli_query($conn, $query);
	$RecNum = mysqli_num_rows($results);

	$percent = $RecNum / $NumRecords * 100;
	return $percent;
}



$dataPoints = array(
	array("label" => "Dedza", "y" => districtpercentage($conn, 'Dedza')),
	array("label" => "Dowa", "y" => districtpercentage($conn, 'Dowa')),
	array("label" => "Kasungu", "y" => districtpercentage($conn, 'Kasungu')),
	array("label" => "Lilongwe", "y" => districtpercentage($conn, 'Lilongwe')),
	array("label" => "Mchinji", "y" => districtpercentage($conn, 'Mchinji')),
	array("label" => "Nkhotakhota", "y" => districtpercentage($conn, 'Nkhotakhota')),
	array("label" => "Ntcheu", "y" => districtpercentage($conn, 'Ntcheu')),
	array("label" => "Ntchisi", "y" => districtpercentage($conn, 'Ntchisi')),
	array("label" => "Salima", "y" => districtpercentage($conn, 'Salima')),
	array("label" => "Chitipa", "y" => districtpercentage($conn, 'Chitipa')),
	array("label" => "Karonga", "y" => districtpercentage($conn, 'Karonga')),
	array("label" => "Likoma", "y" => districtpercentage($conn, 'Likoma')),
	array("label" => "Mzimba", "y" => districtpercentage($conn, 'Mzimba')),
	array("label" => "Nkhata Bay", "y" => districtpercentage($conn, 'Nkhata Bay')),
	array("label" => "Rumphi", "y" => districtpercentage($conn, 'Rumphi')),
	array("label" => "Balaka", "y" => districtpercentage($conn, 'Balaka')),
	array("label" => "Blantyre", "y" => districtpercentage($conn, 'Blantyre')),
	array("label" => "Chikhwawa", "y" => districtpercentage($conn, 'Chikwawa')),
	array("label" => "Chiradzulu", "y" => districtpercentage($conn, 'Chiradzuru')),
	array("label" => "Machinga", "y" => districtpercentage($conn, 'Machinga')),
	array("label" => "Mangochi", "y" => districtpercentage($conn, 'Mangochi')),
	array("label" => "Mwanza", "y" => districtpercentage($conn, 'Mwanza'))
);

?>
<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<head>
	<script>
		window.onload = function() {

			var chart = new CanvasJS.Chart("chartContainer", {
				animationEnabled: true,
				exportEnabled: true,
				theme: "light2",
				title: {
					text: "Crime Distribution in Districts",
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