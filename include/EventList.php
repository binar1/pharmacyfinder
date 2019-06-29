<?php require_once '../init.php';
$catagorey=false;
$events=false;

?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	
	
	</style>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">

	<link rel="stylesheet" type="text/css" href="../css/eventliststyle.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Event List</title>
</head>
<body>
	<div class="container-fluid">
    <?php #include 'Header.php'; ?>
    <?php if (isset($_GET['name'])) {
 	  $catagorey=new Catagorey($_GET['name']);
 	 $eventsId=$catagorey->data()->catagorey_id;
 	 $p1=null;
    $events=new Event($p1,$eventsId,null);
?>
	<div class="container" style="width: 100%; height: 400px; padding-top: 55px;">
		<img style="height: 350px;" src=<?php if ($catagorey) {
			echo"../images/catagorey/".$catagorey->data()->img ;
		}   ?>>
		</div>
		<div class="container" style="width: 100%; height: 150px; text-align: center; font-size: 30px; font-weight: bolder; padding-top: 50px;"><?php if($catagorey){echo "<p style='font-family:Roboto;font-size:40px;'>".$catagorey->data()->name."&nbsp;&nbsp;Events</p>";} ?></div>
		<div class="container"><form>
			<div class="input-group" style="right: 8%;">
				<input type="text" class="form-control" placeholder="Search Event" name="search" style="height: 50px; width: 25%; float: right; padding-left: 1%; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
				<input type="text" name="city" class="form-control" placeholder="City" style="height: 50px; width: 25%; float: right;padding-left:1%; ">
				<select  class="form-control" style="height: 50px;width: 25%; float: right; padding-left: 1%; border-top-left-radius: 7px; border-bottom-left-radius: 7px; ">
					<option selected>All Dates</option>
					<option>Today</option>
					<option>Tomorrow</option>
					<option>This Week</option>
					<option>Next Month</option>
				</select>
				<div class="input-group-btn">
				<button type="button" class="btn btn-info" style="height: 50px; margin-left: 3px; border-radius: 7px;">Search
       			</button></div>
				</div>
		</form></div>
<div class="row container1" style="padding: 5px; width: 100%;">
   <?php 
   
   if ($events->result()) {
      
   
       foreach ($events->result() as $ones) {
       	$price='';
       	if (!$ones->price) {
       		$price='Free';
       	}else{$price .= $ones->price."$";}
     echo "<div class='imageBox col-sm-4' ><img src='../images/Events/$ones->img'>
          <a href='EventDetail.php?number=$ones->event_id'><div class='textBox'>
          <h2 align=center>$ones->name</h2>
          <h3 align=center>Price:$price<h3>
          </div></a>

           </div>";  
       }
   }  ?>
    
 
  </div>
    <?php  }else{
  	?>
<div class="row container1" style="padding: 5px; width: 100%;">
<div class="container-fluid" style="margin-top:60px;height:400px;background-color:rgba(0,0,0,0.9);">
	<h1 align="center"  style="text-transform:capitalize;color:white;margin-top:10%;">you dont select any type of events</h1>
</div>


  <?php } ?>
   <?php include 'Footer.php'; ?>
 </div>
</body>
</html>
