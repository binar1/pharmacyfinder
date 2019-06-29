<?php require_once '../init.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Address</title>
	<link rel="stylesheet" type="text/css" href="../css/OrganizationStyle.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    	@font-face{
 			 font-family:Roboto;
 			 src:'../fonts/Roboto.tff';
		}
		
    	h1
    {
		width: 100%;
		height: 100%;
		font-weight: bold; 
		background-color: rgba(0,0,0,0.5); 
		padding: 10px; 
		color: white;
	}
	td{
		font-size: 18px;
		color:  #1a001a;
		padding: 20px;
		font-weight: bold;
		font-family: Roboto;
	}
	span{
		font-size: 30px;
		font-weight: bold;
		font-family: Roboto;
		color: #260d0d;
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
  <a href="#" class="btn btn-danger">Address</a>
  <a href="CertificationOrganization.php" class="btn btn-danger">Certificate</a>

</div>

<div class="container" style="width: 100%; padding-bottom: 20px; ">
	<h1 ><p align="center">Address Organizer </p></h1>
	<div style="background-color: white; width: 100%; padding: 40px;">
			<div style="background-color: #e1e1d0;padding: 50px; width: 100%;"><!--Address Location -->
				<span><img src="../images/location-pin (1).png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>Address Location</span>
				<table class="table table-striped" style="background-color: #c4c4a1;">
					<tr><td>Country     :</td></tr>
				    <tr><td>Zip Code    : </td></tr>
					<tr><td>City        : </td></tr>
					<tr><td>Street      : </td></tr>
					<tr><td>Company No. : </td></tr>
				</table>
			</div>
			<div style="background-color: #e1e1d0;padding: 50px;"><!--Phone Number -->
				<span><img src="../images/auricular-phone-symbol-in-a-circle.png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>Phone Number</span>
				<table class="table table-striped" style="background-color: #c4c4a1;">
					<tr><td>office Number :</td></tr>
				    <tr><td>Phone  Number : </td></tr>
					<tr><td>Phone  Number : </td></tr>
				</table>
			</div>
			<div style="background-color: #e1e1d0;padding: 50px;"><!--Email -->
				<span><img src="../images/opened-email-envelope.png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>Email Address</span>
				<table class="table table-striped" style="background-color: #c4c4a1;">
					<tr><td>office Email : </td></tr>
				    <tr><td>Employ Email : </td></tr>
				</table>
			</div>
			<div style="background-color: #e1e1d0;padding: 50px;"><!--Website -->
				<span><img src="../images/www.png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>WebSite</span>
				<table class="table table-striped" style="background-color: #c4c4a1;">
					<tr><td>www. </td></tr>
				   
				</table>
			</div>
		</div>
	</div>

</div>
</div>
</div>
</body>
<?php include 'Footer.php';?>

</html>