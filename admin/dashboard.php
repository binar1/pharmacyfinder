<!DOCTYPE html> 

<html lang="en">
<head>
<?php
require_once '../init.php';
$admin=new Admin();
if (!$admin->isLoggedIn()) {
	Redirect::to('index.php');
}
$count=$admin->getAllPostscount()[0]['count(*)'];


?>
<style>

.colm1{
    background: url('../images/manager.png') no-repeat center;
    -webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
    background-size: contain;
    display:table;
    height:300px;
    text-align: center;
    color:white;
    border-radius: 50px 20px
    }
    .colm2{
    background: url('../images/drug.png') no-repeat center;
    -webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
    background-size: contain;
    display:table;
    height:300px;
    text-align: center;
    color:white;
    border-radius: 50px 20px
    }
    .colm3{
    background: url('../images/marketing-strategy.png') no-repeat center;
    -webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
    background-size: contain;
    display:table;
    height:300px;
    text-align: center;
    color:white;
    border-radius: 50px 20px
    }
h3{
    margin: 0;
    height: inherit;
    display: table-cell;
    vertical-align: bottom;
}
h3:after { /* trick to add bottom padding */
    content: '';
    display: block;
    height: 10px; 
}

</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

</head>
<body>
<?php  include 'header.php';  ?>
<div class="row d-flex justify-content-center " style="margin-top:10px;">
<div class="col-xs-12 col-lg-12 col-md-12 m-1 bg-primary text-center mb-5" style="text-align:center;margin:0;">
<h2 class="h2 text-center" style="color:white;">Dashboard</h2>
</div>
<div class="col-xs-2 col-lg-3 col-md-4 m-1" style="  text-align: center;">
<a href="admins.php">
<div class="colm1 w-100 bg-info">
<h3 class="h2">Admins</h3>

</div>
</a>
</div>


<div class="col-xs-2 col-lg-3 col-md-4  m-1">
<a  href="pharmacy.php">
<div class="w-100 bg-info colm2">
<h3 class="h2">Pharmacy</h3>
</div>
</a>
</div>

<div class="col-xs-2 col-lg-3 col-md-4  m-1">
<h3 class=" animated  zoomIn infinite " style="background-color:red;position:absolute;text-align: center;right: 0; width: 50px;color: white; border-radius: 10px 

"><?php  echo $count;  ?></h3>
<a  href="posts.php">
<div class="w-100 bg-info colm3">
<h3 class="h2">Posts</h3>
</div>
</a>
</div>

</div>


</body>
</html>