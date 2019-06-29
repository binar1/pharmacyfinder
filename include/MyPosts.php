<?php  require_once '../init.php';
$user=new user(); 
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>find Pharmacy</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<link rel="stylesheet" type="text/css" href="../css/your_event.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
    	.jumbotron{
    		color: #cd7f32;
    		margin-top: 80px;
    		height: 450px;
    	
    	}
    	.tex{
    		margin-bottom:40px;
    		font-family: monospace;
    		text-shadow: 3px 4px 3px dimgray;
    		font-style:  oblique;
    		letter-spacing: 3px;
    	}
    	.tex:hover{
    		font-size: 80px;
    		font-family: initial;
    		font-style: oblique;
    	}
    	.tow{
    		margin-top: 0;
    		margin-left: 250px;
    		width: 450px;
    		margin-bottom: 0px;
    	}
    </style>
</head>
<body>
	<?php include ('Header.php');?>

	<div class="container jumbotron text-center">
		<h1 class="tex"><?php  echo $user->data()->name; ?></h1>  
		
	</div>
	<div class="container-fluid">
	<h1 align=center>My Products</h1>
		<div class="row">
		<?php  $posts=new Posts($user->data()->id,null);
		for ($i=0; $i <count($posts->findMYPOSt($user->data()->id)) ; $i++) { 
	
	?> 
 <div class="col-lg-3" style="margin:0px;">
 <a href=<?php echo "include/EventDetail.php?number=".$posts->result()[$i]->id; ?>><div class="suggest" style="width:100%;background-color:#f9f9f9;margin-top:-50px;height:200px;background-image:url(<?php echo "../images/posts/".$posts->result()[$i]->img ?>);background-size:cover;">
 <h4 style="margin-top:20%;margin-left:87%;color:white;background-color:#00c365;height:35px;width:55px;"><?php echo $posts->result()[$i]->cost."$"; ?></h4>
 <h3 style="margin-top:25%;color:white;font-weight:bold;font-family:Helvetica;margin-left:10px;background-color:rgba(120, 44, 14,0.5);height:30px;text-align:center;text-transform:capitalize"><?php echo $posts->result()[$i]->name.""; ?></h3>
 </div> </a>
 </div>
		<?php }?>
	</div>
	</div>
	<?php include 'Footer.php'; ?>


</body>
</html>