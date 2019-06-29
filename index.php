 <?php require_once 'init.php';
if(isset($_GET['druge'])){
  $posts=new Posts(null,$_GET['druge']);
}else{
  $posts=new Posts();
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
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="shahram,mirshad">
    <link rel="icon" href="images/logo.png">
    <title>pharmacy finder</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="bug-workaround.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  </head>

    <style type="text/css">
    .carousel-inner > .item >img,
    .carousel-inner > .item > a >img{
         width:100%;
         margin:0px;
    }	
    .carousel-caption{
    	left:0;
    	right:0;
    	width:100%;
    	height:100%;
        padding:0px;
        top:50%;
    }
    @font-face {
       font-family: "Roboto";
       src: url("fonts/Roboto.ttf");  }
       .carousel-caption h3,p{
       	right:0
       	left:0;
       	top:45%;
       	transform:translateY(-50%);
        font-family:'Roboto',sans-serif;
       }
    .carousel-caption h3{
     font-size:5em;
     text-transform:capitalize;
    }
    .carousel-caption p{
    	font-size:2em;
   }
   .catagory-images{
   	width:100%;
   	height:220px;
   	border-radius:7px;
   }
   .col-lg-7{
     height:220px;padding:0;
     margin-bottom:25px;
   }
   .left-images{
   	margin-right:25px;
   }
   .col-lg-4{
    height:220px;padding:0; margin-bottom:25px;
   
   }
    .catagory-images:hover{
    transform: scale(1.05);
    transition:0.7s;
    cursor:pointer;
   }
   
   .catagory-images:hover .detail{
    visibility:visible;
   }
   .detail{
   	visibility:hidden;
   }
   
 .container-cols{
 	position:absolute;
    top:50%;
    left:40%;
    width:100%;
    height:100%;
    margin:0;
	  padding:0;
    font-size:40px;
    color:white;
    text-transform:capitalize;
    font-family:Roboto;
 }
 
.col-lg-4 .container-cols{
  left:30%;
}
.col-lg-7 .container-cols{
  left:50%;
  top:50%;
}
.footer-links:hover{
	text-decoration:none;
}


    </style>

  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50" style="">

   <div class="container-fluid" style="padding:0;">
    <?php 
   
      
          $user=new User();
           if ($user->isLoggedIn()){ ?>
           <div class="alert alert-success alert-dismissible" style="margin-top:70px;" >
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>Success!</strong> Welcome Back <?php echo escape($user->data()->name);  ?>
            </div>
             
         <?php  }else{
            ?>
            <div class="alert alert-warning alert-dismissible" style="margin-top:60px;position:sticky;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong> you need to be <a href="include/Register.php">Register</a>
          </div>
          <?php
           }
     ?>
         
   <?php 
    include 'Header.php';
      ?>

   
   <div id="myCarousel" class="carousel slide" data-ride="carousel">
   <div id="myCarousel" class="carousel slide" style="margin:50px;" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active" style="text-align:center;font-size:40px;font-weight: bold;color:white;"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/daidalany.jpg" alt="Los Angeles" style="width:100%;height:500px;">

      <div class="carousel-caption">
      	<h3>Pharmacy Orzdy</h3>
      	<p></p>
      </div>
    </div>

    <div class="item">
      <img src="images/pill.jpg" alt="Chicago" style="width:100%;height:500px; ">
      <div class="carousel-caption">
      	<h3></h3>
      	<p></p>
      </div>
    </div>

    <div class="item">
      <img src="images/pill2.jpg" alt="New York" style="width:100%;height:500px;">

      <div class="carousel-caption">
      	<h3 class="carousel-title">Pharmacy3</h3>
      	<p></p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"></span>  <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
  <i class="glyphicon glyphicon-chevron-right"></i>
  <span class="sr-only">Next</span>
  </a>
</div>
<div  class="container-fluid" style="margin-top:100px;" >
	<h1 align="center" style="margin-bottom:80px;">All Drugs</h1>
  <div class="d-flex justify-content-center" style="text-align:center">
  <form class="form-inline" action="" method="GET">

   <label for="inputPassword2" class="sr-only">Name Druge</label>
   <input type="text" class="form-control" id="inputPassword2"  name="druge" placeholder="Name Druge" style="width:300px">

 <button type="submit" class="btn btn-primary mb-2" style="width:150px">Search</button>
 <a href="<?php echo $link; ?>" class="btn btn-success mb-2" style="width:150px">Reset</a>

</form>
  </div>
	<div class="row d-flex justify-content-center" style="margin-top:40px;margin-bottom:30px;width:100%;">
       <?php 
        
         for ($i=0; $i < count($posts->result()); $i++) { 
          
          ?>
     
    
 <div class="col-lg-3" style="margin:0px;">
 <a href=<?php echo "include/EventDetail.php?number=".$posts->result()[$i]->id; ?>><div class="suggest" style="width:100%;background-color:#f9f9f9;margin-top:-50px;height:200px;background-image:url(<?php echo "images/posts/".$posts->result()[$i]->img ?>);background-size:cover;">
 <h4 style="margin-top:20%;margin-left:87%;color:white;background-color:#00c365;height:35px;width:55px;"><?php echo $posts->result()[$i]->cost."$"; ?></h4>
 <h3 style="margin-top:25%;color:white;font-weight:bold;font-family:Helvetica;margin-left:10px;background-color:rgba(120, 44, 14,0.5);height:30px;text-align:center;text-transform:capitalize"><?php echo $posts->result()[$i]->name.""; ?></h3>
 </div> </a>
 </div>
    <?php 
       }
       ?>
    
  </div>

</div>

   <?php include 'Footer.php';   ?> 
</div>   

  </body>
</html>
