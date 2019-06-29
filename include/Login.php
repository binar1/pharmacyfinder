<?php require_once '../init.php';
 if (Input::exist()) {
 	if(Token::check(Input::get('token'))){
      $validate=new ValidationMember();
      $validation=$validate->check($_POST,
       array(
       	'email' =>array(
       		'require' => 'true' ,
             'type' => 'email' ,
       		 ),
       	'password' => array('require' => 'true' )
       ));
      if ($validation->passed()) {
      	$user=new User();
        $table='';
      	$remember=(Input::get('remember')==='on') ? true:false ;
       
        

      	$login=$user->login('user',Input::get('email'),Input::get('password'),false);
        
      	if ($login=='true') {
      		Redirect::to('../index.php');
      	}else
      	{
      	  echo "<div class='alert alert-danger alert-dismissible' style='width:400px;margin-left:38%;margin-top:40%;position: absolute;'>
         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
         <p style='font-size:15px;text-transform:capitalize;' align='center'><pp>". $login.
       "</p></div>";
      	}
      }else{

      	foreach ($validation->errors() as $error) {
      		
      		echo "<div class='alert alert-danger alert-dismissible' style='width:400px;margin-left:38%;margin-top:40%;position: absolute;'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <p style='font-size:15px;text-transform:capitalize;' align='center'><p> $error<br>
           </p></div>";
      		
      		
      	}
      }
 	}
 }


  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	    <title>Login</title>
    <link rel="stylesheet" href="../css/Login.css">
    <link rel="icon" href="../images/logo.png">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
		<link rel="stylesheet" type="text/css" href="../css/signup.css">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  </head>

	<body>
		<?php 
		include	 'Header.php';
		 ?>
		<div class="container-fluid" >
		<?php
		   if (Session::exists('home')) {
		    ?>
		    <div class="alert alert-success alert-dismissible" style="margin-top:60px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p style="font-size:25px;"><strong>Success!</strong> <?php echo Session::flash('home');  ?></p> 
  </div>	
		 <?php   
		   }
		 ?>	
		
       
		<div class="container1" style="margin-top:50px;border-radius:20px;">
	<form method="POST" action="#">
		<h1>Login</h1>
		<p>Please Enter Email & Password</p>
		<hr>
		<label for="email"><b>Email</b></label>
		<input class="input1" type="text" placeholder="Enter Email" name="email" required>
		
		<label for="password"><b>Password</b></label>
		<input class="input1" type="password" placeholder="Enter password" name="password" required>
		<label>
			<input class="input1" type="checkbox" checked="checked" name="remember" style="margin-button:15px;">Remember Me
		</label>
		<div class="forget">
		<a href="#">Forget Password</a>
		</div>
		<div>
		<input type="hidden" name="token" value=<?php echo Token::genarate();   ?> >
		<input type="submit" name="login" class="button1" value="Login"></div>
		<label>You can create <a href="signup.php">account</a></label>
	</form>
</div>
		<div class="container-fluid" >
			<?php include 'Footer.php'; ?>
		</div>
		
		
	
</body>
</html>
