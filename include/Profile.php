<?php  require_once '../init.php'; 
$user=new User();
   if (!$user->isLoggedIn()) {
  Redirect::to('../include/Login.php');
}
  if (isset($_POST['Save']) && isset($_GET['part'])) {
    if (Token::check(Input::get('token3'))) {
       $validate=new ValidationMember();
     if (isset($_FILES['file']['name'])){
       $validate->checkImage($_FILES,array('file'=>array('max' =>1000000,'type'=>array('jpeg','jpg' ))));
     if ($validate->passed()) {
         $user->imageCertificate('user',array('certificate' =>$user->ImagesPrepare($_FILES['file'],"Certificate/")));
      header('Location:Profile.php?part=certificate');
    
     }else
     {
      echo "<div class='alert alert-danger alert-dismissible fade in' style='margin-top:70px;'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
  
    foreach ($validate->errors() as $error) {
     echo "$error<br>";
    }
    echo "</div>";

     }


    }
    }
    
  }

 if ((isset($_POST['image']) && isset($_GET['part'])) || isset($_POST['image'])) {
  if (Token::check(Input::get('token1'))) {
  
  $validate=new ValidationMember();
  if ($_FILES['UploadA']['name']) {
    $validate->checkImage($_FILES,array('UploadA'=>array('max' =>1000000,'type'=>array('jpeg','jpg' ))));
  if ($validate->passed()) {
    // $file=addslashes(file_get_contents($_FILES['UploadA']['tmp_name']));
    $user->updateImage('user',array('img' =>$user->ImagesPrepare($_FILES['UploadA'],"Profile/")));
     header('Location:'.$_SERVER['PHP_SELF']);
    
  }else{
    foreach ($validate->errors() as $error) {
     echo "$error";
    }
  }
  
    
  }
}
 }

 if (isset($_POST['update'])) {
  if (Token::check(Input::get('Token'))) {
   $validate =new ValidationMember();
   
    $validate->check($_POST,array(
    'name' => array('require' =>'true' ,'min'=>2 ), 
    'email' => array('require' =>'true' ,'type'=> 'email'),
  )); 
  
  
   
  if ($validate->passed()) {
  
    $anjam= $user->updateInfo('user',array('name'=>Input::get('name'),'open'=>Input::get('opentime'),'close'=>Input::get('closetime'),'email'=>Input::get('email'),'no_phone'=>Input::get('phone'),'address'=>Input::get('address'),'about'=>Input::get('about')),Input::get('pwd'));
      if($anjam=='true'){
        Session::flash('info','Your Information updated');
        header('Location:Profile.php?part=setting');
 
      }else{
        echo "<div class='alert alert-danger alert-dismissible fade in' style='margin-top:70px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        $anjam
        </div>";
      }
    

   }else{
    echo "<div class='alert alert-danger alert-dismissible fade in' style='margin-top:70px;'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
  
    foreach ($validate->errors() as $error) {
     echo "$error<br>";
    }
    echo "</div>";
   }

  }
 }


if (isset($_POST['changepass']) && isset($_GET['part'])) {
  if (Token::check(Input::get('token2'))) {
 
 
  $validate=new ValidationMember();
  $validation=$validate->check($_POST,array(
    'OldPassword' =>array('min' => 6,'max'=>10 ),
    'NewPassword'=>array('min' => 6,'max'=>10 ),
    'Re-NewPassword'=>array('matches' => 'NewPassword')
     ));
  if ($validate->passed()) {
    try
    {
    $user=new User();
    $res=$user->updateInfo('user',array('password'=>Hash::make(Input::get('NewPassword'),$user->data()->salt)),Input::get('OldPassword'),null);
    
    if($res=='true'){
      Session::flash('home','Your password changed');
    }else{
      ?>
 <div class="alert alert-danger alert-dismissible" style="margin-top:70px;" >
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php  echo $res; ?>
            </div>

      <?php
    }
    }
    catch(Exception $e){
      die($e->getMessage());
    }
    
  }else{
    ?>
    <div class="alert alert-danger alert-dismissible" style="margin-top:70px;" >
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php foreach ($validate ->errors() as $error) { echo $error."<br>"; } ?>
            </div>
      ;
    <?php 
  }
 }
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
  <link rel="icon" href="../images/logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script >
    $(document).ready(function(){
      $("#photo").load("../classes/User.php");
    });
  </script>
</head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
<style type="text/css">
 .list-group a{
padding-bottom:20px;
 }
 .pro-pic-bg{
 	background-color:#f6f6f6;width:160px;height:160px;margin-left:25.2%;margin-top:-245px;border-radius:100px; position:absolute;opacity:0;
 }
 .pro-pic-bg:hover {
  opacity:0.8;
  cursor:pointer;
 }
 
</style>
<body>
	<div class="container-fluid">
	<?php include 'Header.php'; ?>

<div class="row" >
 <div class="col-lg-4"  style="width:350px;height:650px;margin-left:20px;margin-top:30px;overflow:hidden; background-color:#f6f6f6;position:relative;">

  <?php
   if($user->data()->img){ echo '<img  src="../images/Profile/'.$user->data()->img.'" style="width:158px;height:160px;margin-left:28%;margin-top:10%" class="img-circle">';}else{echo "<img src=../images/Profile.png style='width:158px;height:160px;margin-left:28%;margin-top:10%;' class='img-circle' >";} ?> 
    <form action="" method="POST" enctype= multipart/form-data>
     <div style="height:20px;margin-left:40%;margin-top:10px;">
      <input type="hidden" name="token1" value=<?php echo Token::genarate(); ?> >
      <input type="submit" name="image" value="Change"  class="btn btn-info">
     </div> 
    <h3 align="center" style="text-transform:capitalize;"><?php echo $user->data()->name;  ?></h3>
    <div class="pro-pic-bg">
      <input type="butoon" name="UploadB" value="Upload" class="btn-warning" style="margin-top:50%;margin-left:28%;border-radius:20px;height:35px;width:80px;opacity:1;padding-left:13px">
      <input type="file" name="UploadA" accept="image/*"  style="margin-top:50%;margin-left:28%; width:80px;position:absolute;margin-top:-30px;opacity:0;cursor:pointer;">
  </div>
  
  </form>
  <div class="list-group" style="margin-top:10px;width:350px;margin-left:-15px;position:absolute;margin-bottom:50px;">
  <a href="?part=setting" class="list-group-item list-group-item-action text-center">Setting</a>
  <a href="?part=password" class="list-group-item list-group-item-action text-center">Change Password</a>
  <a href="AddPosts.php" class="list-group-item list-group-item-action text-center">Add Post</a>
  <a href="MyPosts.php" class="list-group-item list-group-item-action text-center">My Posts</a>
  <a href="MyLocation.php" class="list-group-item list-group-item-action text-center">Add my Location</a>
  <a href="showmylocation.php?profile=<?php echo $user->data()->id;?>" class="list-group-item list-group-item-action text-center">Show my Location</a>
  <a href="Profile.php?part=certificate" class="list-group-item list-group-item-action text-center">My Certificate</a>
  
</div>

</div>
<div class="col-sm-7" style="margin-top:70px; width:60%;">
 <?php if (Session::exists('home')) {?>
            <div class="alert alert-success alert-dismissible" style="margin-top:20px;" >
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>Success!</strong>  <?php echo Session::flash('home'); ?>
            </div>
  
<?php 
Session::delete('home');
}
 ?>
<?php
  if (isset($_GET['part'])) {
  	if ($_GET['part']=="setting") {
  	?>
       <?php if (Session::exists('info')) {?>
            <div class="alert alert-success alert-dismissible" style="margin-top:20px;" >
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>Success!</strong>  <?php echo Session::flash('home'); ?>
            </div>
  
      <?php 
Session::delete('info');
    
    } ?>
     <form action="" class="form-horizontal" method="POST" style="margin-left:10%;" action="" >
   
       <div class="form-group">
        <label class="control-label col-sm-2">Name:</label>
        <div class="col-sm-10">
        <?php echo "<input type='text' name='name' class='form-control' width='500px;' value='".$user->data()->name."' required >"; 
          ?>
        </div>
        
        </div>
       
     	
     	<div class="form-group">
     		<label class="control-label col-sm-2">Email</label>
     		<div class="col-sm-10">
     			<input type="email" name="email"  required class="form-control" width="400px;" value=<?php echo escape($user->data()->email); ?>>
     		</div>
     		
     	</div>
     	<div class="form-group">
     		<label class="control-label col-sm-2">Phone</label>
     		<div class="col-sm-10">
     			<input type="number" name="phone" class="form-control" width="400px;"  required value=<?php echo escape($user->data()->no_phone); ?>>
     		</div>
     		
     	</div>
     	<div class="form-group">
     		<label class="control-label col-sm-2">Address</label>
     		<div class="col-sm-10">
     			<input type="text" name="address" class="form-control" width="400px;"  required value=<?php echo escape($user->data()->address); ?> require>
     		</div>
     		
     	</div>
       <div class="form-group">
     		<label class="control-label col-sm-2">Open time </label>
     		<div class="col-sm-10">
         <input type="time" class="form-control" id="en" name="opentime" style="width:150px;" value=<?php echo escape($user->data()->open); ?>>
     		</div>
     		
     	</div>
       <div class="form-group">
     		<label class="control-label col-sm-2">Close time</label>
     		<div class="col-sm-10">
         <input type="time" class="form-control" id="en" name="closetime" style="width:150px;" value=<?php echo escape($user->data()->close); ?>>
     		</div>
     		
     	</div>
     
      <hr style="height:1px;background-color:black;">
<div class="form-group" style="margin-left:5%;">
      <label >About</label>
      <textarea class="form-control" style="resize:none;" cols="20" rows="5" name="about"><?php echo $user->data()->about ?></textarea>
    </div>
    <div class="container" style="background-color:black;margin-left:20%;">
      
    </div>
      <hr style="height:2px;background-color:black">
     	<div class="form-group">
     		<label class="control-label col-sm-2">password</label>
     		<div class="col-sm-10">
     			<input type="password" name="pwd" class="form-control" width="400px;" style="text-align:center;" placeholder="Enter Your Password to update" require>
     		</div>
     		
     	</div>
      <input type="hidden" name="Token" value=<?php echo Token::genarate(); ?>>
     	<input type="submit" name="update" value="Update" class="btn btn-success " style="margin-left:50%;"/>
     </form>

  	<?php
  	}

    if($_GET['part']=="certificate"){
    ?>
    <div class="container" style="margin-left:20%;width:600px;height:400px;">
     <div style="background-color:rgba(0,0,0,0.9);width:100%;height:40px;color:white;"><h2 align="center">Upload Your certificate</h2></div> 
     <form enctype= multipart/form-data style="padding-left:25%;padding-top:10%;width:100%;" action="Profile.php?part=certificate" method="POST">
       <input type="file" name="file" accept="image/*" style="position:absolute;margin-top:8px;width:250px;background-color:transparent;opacity:0;color:transparent;">
       <input type="button" name="btn-certificate" class="btn btn-primary" value="Browse" style="width:150px;" >
       <input type="hidden" name="token3" value=<?php echo Token::genarate(); ?>>
      <input type="submit" name="Save" value="Save" class="btn btn-success" style="position:relative;width:150px;">
     </form> 
     <img src=<?php if(!$user->data()->certificate){ echo "../images/certificate.png";}else{ echo "../images/Certificate/".$user->data()->certificate;} ?> style="height:300px;width:100%;margin-top:20px;">

    </div>
    <?php }
?>   





  <?php	if($_GET['part']=="password"){
  		?>
   <form action=<?php echo htmlspecialchars("Profile.php?part=password"); ?> style="margin-left:10%;" method="POST">
   	<div class="form-group">
   		<label >Old Password</label>
   		<input type="password" name="OldPassword" class="form-control" width="400px;" required>
   	</div>
   	<div class="form-group">
   		<label>New Password</label>
   		<input type="password" name="NewPassword" class="form-control" width="400px;" required>
   	</div>
   	<div class="form-group">
   		<label >Re-New Password</label>
   		<input type="password" name="Re-NewPassword" class="form-control" width="400px;" required>
   	</div>
    <input type="hidden" name="token2" value=<?php echo Token::genarate(); ?>>
   	<input type="submit" name="changepass" value="Change" class="btn btn-warning" style="margin-left:40%;">
   </form>

  	<?php
  	}
  }

  ?>
  </div>
  
</div>
<?php 
    include 'Footer.php';
  ?>	
	</div>
	

</body>
</html>