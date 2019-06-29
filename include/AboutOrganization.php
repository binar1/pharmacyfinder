<?php require_once '../init.php';
$user=new User();
$organization=false;
if (!isset($_GET['profile'])) {
  Redirect::to(4041);
}else{
	$organization=new User($_GET['profile'],'organization');
}
if (!$user->isLoggedIn()) {
	Redirect::to('Login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>About</title>
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
    </style>
</head>
<?php include 'Header.php';?>
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
  <a href="#" class="btn btn-danger">About</a>
  <a href="AddressOrganization.php" class="btn btn-danger">Address</a>
  <a href="CertificationOrganization.php" class="btn btn-danger">Certificate</a>

</div>


<div class="container" style="width: 100%">
	<h1 ><p align="center">About Organizer </p></h1>

	<div style="background-color: white; width:100%">
		<div style="width: 100%;">
			<p style="text-align: justify; padding: 15px; font-size: 20px; font-weight: bold;">
				is the world's largest event technology platform. We build the technology to allow anyone to create, share, find and attend new things to do that fuel their passions and enrich their lives. Music festivals,venues, marathons, conferences, hackathons, air guitar contests, political rallies, fundraisers, gaming competitions - you name it, we power it. Our mission? To bring the world together through live experiences.
			</p>

		</div>
	</div>
</div>
</div>
</div>
</body>
<?php include 'Footer.php';?>

</html>