<?php require_once '../init.php';  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Certification</title>
	<link rel="stylesheet" type="text/css" href="../css/OrganizationStyle.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    	h1
    {
		width: 100%;
		height: 100%;
		font-weight: bold; 
		background-color: rgba(0,0,0,0.5); 
		padding: 10px; 
		color: white;
	}
	span{
		font-size: 25px;
		font-weight: bold;
		font-family: Roboto;
		
		width: 100%;
		color: white;
	}
	
    </style>
</head>
<?php include 'header.php';?>
<body>
<div class="container" style="padding-top: 50px;">
<div class="row divbg">
	<div class="col-sm-3 divimage" >
		<img src="../images/b.jpg" style="width: 200px; height: 200px; border-radius: 25px; ">
	</div>
	<div class="col-sm-3 divname" style="margin-top: 80px;">company name
	</div>
	<div class="col-sm-5 divname">
		<p style="margin-top: 80px;">
			<label>Address : Sulaymany</label>
			<label>Phone Number : +9647700000000</label>
		</p>
	</div>

	<div class="btn-group btn-group-justified">
  <a href="ProfileOrganization.php" class="btn btn-danger">Events</a>
  <a href="AboutOrganization.php" class="btn btn-danger">About</a>
  <a href="AddressOrganization.php" class="btn btn-danger">Address</a>
  <a href="#" class="btn btn-danger">Certificate</a>

</div>

<div class="container" style="width: 100%; padding-bottom: 20px;">
	<h1 ><p align="center">Certification</p></h1>
	  	<span><p align="center">Its Company Certificate</p> </span>
		<div class="container" style="background-color: white; width: 100%">
			
			<img src="../images/cinama.png" style="width: 100%; padding: 20px;">
			
		</div>
	</div>
	
	
</div>
</div>
</div>
</body>
<?php include 'Footer.php';?>

</html>