<?php
 require_once '../init.php';
$user=new User();
$organization=false;
$organization=new User($_GET['profile'],'user');

// if (!isset($_GET['profile'])) {
//   Redirect::to(4041);
// }else{
// 	$organization=new User($_GET['profile'],'user');
// }
// if (!$user->isLoggedIn()) {
// 	Redirect::to('Login.php');
// }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/OrganizationStyle.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php  include  'Header.php';?>
<body>
<div class="container" style="padding-top: 80px;">
<div class="row divbg">
	<div class="col-sm-3 divimage" >
		<img src=<?php if(!$organization->data()->img){echo "../images/Profile.png";}else{ echo "../images/Profile/".$organization->data()->img ;}  ?> style="width: 200px; height: 200px; border-radius:100px; ">
	</div>
	<div class="col-sm-3 divname" style="margin-top: 80px;"><?php echo $organization->data()->name ?>


	<?php if ($organization->data()->verify!=0) {
		echo "<img src='../images/verify.png' width='35px' height='35px' style='margin-left:20px;'>";
	} ?>	
	</div>
	<div class="col-sm-5 divname">
		<p style="margin-top: 80px;">
			<label>Address : <?php echo $organization->data()->address ?></label><br>
			<label>Phone Number : <?php echo $organization->data()->no_phone ?></label>
			<label>Open At : <?php echo $organization->data()->open ?> to  <?php echo $organization->data()->close ?> </label>
		</p>
	</div>

	<div class="btn-group btn-group-justified" style="width: 100%;">
  <a href=<?php echo "ProfileOrganization.php?profile=".$_GET['profile']; ?> class="btn btn-danger" style="width: 25%;" class="active">Posts</a>
  <a href=<?php echo "ProfileOrganization.php?part=about&profile=".$_GET['profile']; ?> class="btn btn-danger" style="width: 25%;">About</a>
  <a href=<?php echo "ProfileOrganization.php?part=address&profile=".$_GET['profile']; ?> class="btn btn-danger" style="width: 25%;">Address</a>
  <a href=<?php echo "ProfileOrganization.php?part=certificate&profile=".$_GET['profile']; ?> class="btn btn-danger" style="width: 25%;">Certificate</a>
  <a href=<?php echo "showmylocation.php?profile=".$organization->data()->id; ?> class="btn btn-danger" style="width: 25%;">map</a>


</div>
</div>
</div> 
<div class="container">
	<?php if(!isset($_GET['part'])) { ?>
	<div class="row" style="background-color: white; width: 100%;height:400px;overflow:scroll;">
		<?php
           $events=new Event(null,null,$organization->data()->id);
           if ($events->result()) {
           foreach ($events->result() as $ones) {
           	
		 ?>
		 <a href=<?php echo "EventDetail.php?number=".$ones->id; ?>>
		<div class="col-sm-12">
			<div class="col-sm-3 divimage">
				<img src=<?php echo "../images/posts/".$ones->img; ?> style="width: 150px;height: 150px;">
			</div>
			<div class="col-sm-8">
				<table style="width: 100%;font-size: 20px;font-weight: bold; margin: 20px;margin-top:40px;margin-left:10px;">
					<tr>
						<td style="text-transform:capitalize;">Name:&nbsp;<?php echo $ones->name; ?> </td>
					</tr>
					<tr>
					<td style="text-transform:capitalize;">Price:&nbsp;<?php echo $ones->cost."$"; ?> </td>
				
					</tr>
					<tr>
						<td>Address:<?php echo $organization->data()->address; ?></td>
					</tr>

				</table>
			</div>
		</div>
	</a>
		<hr style="width: 100%;height:1px;background-color:black">
		<?php } } ?>
	</div>
<?php } ?>

<!-- about part -->
<?php if (isset($_GET['part'])&&$_GET['part']==='about') {
	?>
   <h1 ><p align="center">About Pharmacy </p></h1>

	<div style="background-color: white; width:100%">
		<div style="width: 100%;">
			<p style="text-align: justify; padding: 15px; font-size: 20px; font-weight: bold;">
				<?php echo $organization->data()->about; ?>
			</p>

		</div>
	</div>


<?php }  ?>

<!-- address part -->
<?php if (isset($_GET['part'])&&$_GET['part']==='address') {
	?>
<h1 ><p align="center">Address Organizer </p></h1>
	<div style="background-color: white; width: 100%; padding: 10px;border:1px solid black;">
			<div style="background-color: white;padding: 10px;padding-left:60px;"><!--Address Location -->
				<span><img src="../images/location-pin (1).png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>Address Location</span>
				<table class="table table-striped " style="background-color:black;">
					<tr><td>Address     :<?php echo $organization->data()->address; ?></td></tr>
				</table>
			</div>
			<div style="background-color: white;padding: 50px;"><!--Phone Number -->
				<span><img src="../images/auricular-phone-symbol-in-a-circle.png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>Phone Number</span>
				<table class="table table-striped" style="background-color: #c4c4a1;">
					<tr><td> Number : <?php echo $organization->data()->no_phone; ?></td></tr>

				</table>
			</div>
			<div style="background-color: white;padding: 50px;"><!--Website -->
				<span><img src="../images/www.png" style="width: 50px;height: 50px; padding: 10px;"></span>
				<span>WebSite</span>
				<table class="table table-striped" style="background-color: #c4c4a1;">
					<tr><td>www. </td></tr>
				   
				</table>
			</div>
		</div>

<?php } ?>

<?php if (isset($_GET['part'])&&$_GET['part']==='certificate') { ?>
<div class="container" style="width: 100%; padding-bottom: 20px;">
	<h1 ><p align="center">Certification</p></h1>
	  	<span><p align="center">Its Company Certificate</p> </span>
		<div class="container" style="background-color: white; width: 100%">
			
			<img src=<?php echo "../images/Certificate/".$organization->data()->certificate ?> style="width: 100%; padding: 20px;">
			
		</div>
	</div>



<?php } ?>


</div>
</body>
<?php include 'Footer.php';?>

</html>