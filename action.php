<?php 
require_once 'init.php';
	$edu = new User();
	$status = $edu->updatePharmacyWithLatLng($_REQUEST['id'],$_REQUEST['lat'],$_REQUEST['lng']);
	if($status == true) {
		echo "Updated...";
	} else {
		echo "Failed...";
	}
 ?>