<?php require_once '../init.php';
   if (isset($_POST['submtImage'])) {
   	$validate=new ValidationMember();
      $validate->checkImage($_FILES,array(
      	'image' =>array('max' => 1000000 , 'type'=>array('jpg','jpeg'))
      	));
      if ($validate->passed()) {
      	echo "darchw";
      }else
      {
      	foreach ($validate->errors() as $error) {
      		echo "$error<br>";
      	}
      }
   }
    
   ?>

<!DOCTYPE html>
<html>
<head>
	<title>PhotoProfile</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<script type="text/javascript">
		function imageB(){
			document.getElementById('saraki').style.opacity=0.7;
			document.getElementById('buttonUpload').style.opacity=1;
			
		}

		function imageA(){
			document.getElementById('buttonUpload').style.opacity=0;
			document.getElementById('saraki').style.opacity=0.9;
		}
	</script>

</head>
<body>
<div class="container-fluid">
  <?php # include'Header.php';   ?>
<div class="container"  style="padding: 0;left:50%;background-color:#f3f3f3;height:500px;width:600px;margin-top:80px;">
	<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST" enctype="multipart/form-data" >
	<div style="background-color:rgba(0,0,0,0.9);height:50px;width:100%;"><p align="center" style="color:#f6f6f6;top:50%;font-size:25px;">Upload Your Image</p></div>
	<div id="saraki" onmouseover="imageB()" onmouseout="imageA()" style="margin-left:25%;background-color:black;height:300px;width:300px;border-radius:150px;margin-top:30px;">
	<input type="button" id="buttonUpload" name="Upload" value="Upload" class="btn btn-danger" style="margin-left:40%;margin-top:50%;opacity:0;cursor:pointer;">
	<input type="file" id="buttonFile" name="image" style="margin-left:8%;position:absolute;margin-top:-2%;opacity:0;cursor:pointer;">
	</div>
   <h2 align="center" style="margin-left:20px;">Binar</h2>
   <input type="submit" id="submitImage" name="submtImage" class="btn btn-primary" style="width:100%;height:50px;" value="Save">
</form>
</div>
</div>
</body>
</html>