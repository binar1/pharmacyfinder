
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="shahram,mirshad">
    <link rel="icon" href="../images/logo.png">
    <title>pharmacy finder</title>
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="../bug-workaround.css" rel="stylesheet">
    <link href="../navbar.css" rel="stylesheet">
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  </head>
<?php 
require_once '../init.php';
require_once 'Header.php';
$user=new User();

if(isset($_GET['pharmacy'])){
  $data=$user->getOnepharmacy($_GET['pharmacy']);
  
}else{
    $data=$user->getAllPharmacy();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
  
// Here append the common URL characters. 
$link .= "://"; 
  
// Append the host(domain name, ip) to the URL. 
$link .= $_SERVER['HTTP_HOST']; 
  
// Append the requested resource location to the URL 
$link .= $_SERVER['REQUEST_URI']; 
$path=strpos($link,'?');
$link=substr($link,0,$path);
// Print the link 

?>

<div class="container" style="margin-top:100px;">

<div class="row" >
<div class="col-md-12">
<div class="d-flex justify-content-center" style="text-align:center">
  <form class="form-inline" action="" method="GET" >

   <label for="inputPassword2" class="sr-only">Name Pharmacy</label>
   <input type="text" class="form-control" name="pharmacy" id="inputPassword2" placeholder="Name Pharmacy" style="width:300px">

 <button type="submit" class="btn btn-primary mb-2" style="width:150px">Search</button>
 <a href="<?php echo $link; ?>" class="btn btn-success mb-2" style="width:150px">Reset</a>
</form>
  </div>
</div>
<center>
<?php
 

for ($i=0; $i <count($data) ; $i++) { 
   

?>

<div class="col-md-4 align-self-center" >
 <a href=<?php echo "ProfileOrganization.php?profile=".$data[$i]['id'];  ?>><div class="suggest" style="width:100%;background-color:#f9f9f9;margin-top:-50px;height:200px;background-image:url(<?php echo "../images/Profile/".$data[$i]['img'] ?>);background-size:cover;">
 <h4 style="margin-top:20%;margin-left:85%;color:white;background-color:transparent;height:35px;width:55px;">
 <?php 
    if($data[$i]['verify']){

        echo "<img src='../images/verify.png' width='50px'  />";
  }
   

  ?>
 </h4>
 <h3 style="margin-top:25%;color:white;font-weight:bold;font-family:Helvetica;margin-left:10px;background-color:rgba(120, 44, 14,0.5);height:30px;text-align:center;text-transform:capitalize"><?php echo $data[$i]['name'].""; ?></h3>
 </div> </a>
 </div>

<?php

}
?>
</center>

</div>

</div>

<?php include 'Footer.php'; ?>