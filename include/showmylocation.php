<!DOCTYPE html>
<html>
<head>
	<title>Pharmacy On the Map</title>
	<script type="text/javascript" src="..\js\googlemap.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <link rel="icon" href="../images/logo.png">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css">
		.containaraka {
			height:650px;
			width:100%;
			margin-top:70px;
		}
		#map {
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}
	</style>
</head>

<?php  require_once '../init.php';  include  'Header.php';?>


<body>

	<div class="containaraka">
	<center><h1>Find all Pharmacy On The Map</h1></center>
		
		<?php 
		   if(isset($_GET['profile'])){
            $user = new User();

			$allData = $user->getOnepharmacyByID($_GET['profile']);

           }else{
               header("location:../index.php");
           }
			
			// print_r($allData);
			// $allData = html_entity_decode($allData);
			$allData = json_encode($allData, true);
			
			echo '<div id="allData">' . $allData . '</div>';

			$coll = $user->getPharmacyBlankLatLng();
			$coll = json_encode($coll, true);
			echo '<div id="data">' . $coll . '</div>';

						
		 ?>
		<div id="map"></div>
	</div>
</body>

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlslFcjl7vMnMmQXYIkLygMURUsVJG20E&callback=loadMap">
  </script>
</html>