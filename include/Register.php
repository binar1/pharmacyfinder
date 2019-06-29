<?php require_once '../init.php'; 
 //if(Token::check(Input::get('token'))){ echo "haya";}
$FirstNameErr=$LastNameErr=$EmailErr=$NumberPhoneErr=$PasswordErr=$RePasswordErr=$dateErr=$GenderErr='';
$OrganizationNameErr=$OrganizationEmailErr=$OrganizationAddressErr=$OrganizationPasswordErr=$Re_PasswordErr='';
if(isset($_POST['register'])){
$validate= new ValidationMember();
$validation=$validate ->check($_POST,array(
  'pharmacyName'=>array(
    'require' => 'true',
    'type' => 'text', 
    'min' => '2',
    'max' => '30' ),
  'pharmacyAddress'=>array(
    'require' => 'true' ),
  'pharmacyEmail'=>array(
    'require' => 'true',
    'type' => 'email',
    'min' => '6',
    'unique'=>'user'),
  'pharmacynNumberPhone' =>array(
    'require' => 'true',
    'type' => 'number',
    'min' => '2',
    'max' => '10',
    'unique'=>'customer'
     ),
  'pharmacyPassword' =>array(
    'require' => 'true',
    'min' => '6',
     ),
  'pharmacyRe_Password' =>array(
    'require' => 'true',
    'min' => '6',
    'matches'=>'pharmacyPassword'
     )
));
if ($validate->passed()) {
	
	$user=new User();
  $salt=Hash::salt(32);
  try{
  $user->create('user',array(
    'name' =>$_POST['pharmacyName'],
    'email' =>Input::get('pharmacyEmail'),
    'password' =>Hash::make(Input::get('pharmacyPassword'),$salt),
    'salt' =>$salt,
    'address' =>Input::get('pharmacyAddress'),
    'no_phone' =>Input::get('pharmacyphone'),
    'date' =>date('Y-m-d H:i:s'),
     ));
   Session::flash('home', 'you have been registered AS pharmacy and can now log in !!');
   Redirect::to('Login.php');
  }
  catch(Exception $e){
     die($e->getMessage());
  }


	}else{
	 

        foreach ($validate->errors() as $error) {
        	
              $strpos =strpos( $error,',');
             $varable= substr($error,0, $strpos);
            switch ($varable) {
            	    case 'pharmacyName':
            		$OrganizationNameErr=$error;
            		break;
            		case 'pharmacyAddress':
            		$OrganizationAddressErr=$error;
            		break;
            		case 'Email':
            		$OrganizationEmailErr=$error;
            		break;
            		case 'pharmacyNumberPhone':
            		$OrganizationNumberPhoneErr=$error;
            		break;
            		case 'pharmacyPassword':
            		$OrganizationPasswordErr=$error;
            		break;
            		case 'pharmacyRe_Password':
            		$OrganizationRe_PasswordErr=$error;
            		break;
            	
            	default:
            		# code...
            		break;
            }
                 
        	
        }
	

}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
  <link rel="icon" href="../images/logo.png">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/signup.css">  
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	 
	<style type="text/css">
		#form{
			padding-top: 100px;
			background-color: rgba(0,0,0,0.9);
			height:600px;
			margin-top:100px;
			border-radius:20px;
		}
       label{
       	color:white;
       	font-family:Time New Roman;
       }
       .btn{
       	margin-top:80px;
       }
       .organization-btn{
       margin-left:30%;
       border:.5px solid #d9534f;
       color:#d9534f;
       width:110px;
       height:32.4px;
       
       }
       .organization-btn:hover{
       	background-color:#d9534f;
        border:.5px solid black;
        color:black;
         border-radius:5px;
       }
       .member-btn{
          border:.5px solid #5bc0de;
          color:#5bc0de;
          width:110px;
          height:32.4px;
       }
       .member-btn:hover{
        background-color:#5bc0de;
        border:.5px solid black;
         color:black;
         border-radius:5px;
       }
    .form-group{
    	padding-left:50px;
    }
    .close:active {
    	display:none;
    }

	</style>
	
</head>
<body style="background-color: #ebebe0">
	<div class="container-fluid">
	<?php include 'Header.php';  ?>
	
  </div>

  <div>
    
    
  </div>
    <div class="container1 form-form" style="background-color:rgba(0,0,0,.9);margin-top: 60px;width:60%;border-radius:20px;">

    <form method="POST" class="form-horizontal" action=<?php echo htmlspecialchars('Register.php'); ?> style="margin-top:30px;">
  <h1 align="center" style="margin-bottom: 50px;font-family:swift;font-weight:bold;color:#f9f9f9">Oganization Register</h1>
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
      <input type="text" name="pharmacyName" style="width:80%; float:left;" class="form-control" id="fname" placeholder="Name" >
    </div> 
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" style="width:80%;" name="pharmacyEmail" class="form-control" id="email" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="number">Phone:</label>
    <div class="col-sm-10">
      <input type="number" name="pharmacynNumberPhone" style="width:80%;" class="form-control" id="number" placeholder="Enter Phone Number">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="address">Address:</label>
    <div class="col-sm-10">
      <input type="text" name="pharmacyAddress" style="width:80%;" class="form-control" id="address" placeholder="Enter address ">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2"  for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" name="pharmacyPassword" style="width:80%;" class="form-control" id="pwd" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-4" style="margin-left:-65px;"  for="pwd"> RE-Password:</label>
    <div class="col-sm-8"> 
      <input type="password" name="pharmacyRe_Password" style="width:100%;" class="form-control" id="repwd" placeholder="Enter password">
    </div>
  </div>

  <div class="form-group" style="margin-top:-100px;"> 
     <div class="col-sm-offset-2 col-sm-10">
     <input type="hidden" name="token" value=<?php echo Token::genarate(); ?>>
      <input type="submit" onmouseover="this.style.backgroundColor='#5cb85c';this.style.color='black'" onmouseout="this.style.backgroundColor='transparent';this.style.color='#5cb85c'" name="register" style="width:200px;margin-left: 15%;color:#5cb85c;background-color:transparent;border:2px solid #5cb85c;" 
      class="btn submit-btn" value="Register" />
  </div>
</form>	

	
	
 </div>

</div>
<?php
   
   if (isset($_POST['register'])) {
        if (!empty($validate->errors())) {
   	?>
   <div id="closeVali"  class="alert alert-danger alert-dismissible closeVali" style="padding:30px;opacity:0.9; position:absolute;top:20%;left:71%;width:400px;">
    <a data-dismiss="alert" aria-label="Close" class="closeVali" style="cursor:pointer;"  >&times;</a>
     <?php
          	foreach ($validate->errors() as $error) {
           	echo "<p >$error</p><br>";
           } ?>
                    

  </div>

    <?php } }?>
<?php include 'Footer.php';  ?>
</body>
</html>



