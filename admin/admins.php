<?php require_once '../init.php';
$admin=new Admin();
if(isset($_POST['del'])){


if(Token::check(Input::get('token'))){

$bool= $admin->deleteadmin($_POST['del']);
if($bool){
    header("Location:admins.php");
}else{
  echo "false";
}
}
}
 $validate= new ValidationMember();
if(isset($_POST['addadmin'])){

 
$validation=$validate->check($_POST,array(
  'nadmin'=>array(
    'require' => 'true',
    'type' => 'text', 
    'min' => '2',
    'max' => '30' ),
  'aadmin'=>array(
    'require' => 'true' ),
  'eadmin'=>array(
    'require' => 'true',
    'type' => 'email',
    'min' => '6',
    'unique'=>'admin'),
  
  'padmin' =>array(
    'require' => 'true',
    'min' => '6',
     )
));

}

if ($validate->passed()) {
	
	$adminn=new Admin();
  $salt=Hash::salt(32);
  try{
  $adminn->create('admin',array(
    'name' =>$_POST['nadmin'],
    'email' =>Input::get('eadmin'),
    'password' =>Hash::make(Input::get('padmin'),$salt),
    'salt' =>$salt,
    'address' =>Input::get('aadmin'),
    'date' =>date('Y-m-d H:i:s'),
     ));
   
   Redirect::to('admins.php');
  }
  catch(Exception $e){
     die($e->getMessage());
  }


  }
  
             
      



    if (isset($_POST['addadmin'])) {
      if (!empty($validate->errors())) {
   ?>
 <div id="closeVali"  class="alert alert-danger alert-dismissible closeVali" style="padding:30px;opacity:0.9; position:absolute;top:10%;left:40%;width:400px;">
  <a data-dismiss="alert" aria-label="Close" class="closeVali" style="cursor:pointer;"  >&times;</a>
   <?php
          foreach ($validate->errors() as $error) {
           echo "<p >$error</p><br>";
         } ?>
                  

</div>

  <?php } }?>




<!DOCTYPE html>
<html lang="en">
<head>
<?php

    ?>
<style>
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="w-100 p-4">
<a href="dashboard.php" class="btn btn-info btn-lg">
<i class="fa fa-chevron-left" aria-hidden="true"></i> Back
        </a>
</div>
<div class="w-100 bg-info mt-4" style="border-radius:50px;height:50px;">
<h2 class="h2 text-center" style="color:white;">Admin Page</h2>
</div>
<div class="w-100 text-right  p-4">
<a class="btn btn-outline-success " data-toggle="modal" data-target=".bd-example-modal-lg">Add Admin</a>
</div>
<div class="container-fluid">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Adress</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $data=$admin->getAllAdmins();
  
    for($i=0;$i<count($data);$i++){
  
  ?>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $data[$i]['name']; ?></td>
      <td><?php echo $data[$i]['email'];?></td>
      <td><?php echo $data[$i]['address'];?></td>
      <td>
      <!-- <form method="POST" action=""> -->
      <!-- <input type="hidden" name="token" value=<?php echo Token::genarate();   ?> >    -->
      <button class="btn btn-outline-danger " data-toggle="modal" data-target="#exampleModal" value="<?php echo  $data[$i]['admin_id']; ?>"   onclick="data('<?php echo  $data[$i]['admin_id']; ?>')"><i class="fa fa-trash"></i> Trash</button>
      <!-- </form> -->
      </td>
    </tr>
    <?php   }  ?>
  </tbody>
</table>
</div>
<script>
 function data(data){
document.getElementById('deleteButton').value=data;
}
</script>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header ">
        <h5 class="modal-title " id="exampleModalLabel">Add admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <form action="" method="POST">
      <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" name="nadmin" class="form-control" id="name" autofocus>
    </div>
    <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" name="eadmin" class="form-control" id="email">
    </div>
    <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" name="aadmin" class="form-control" id="address">
    </div>
      <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="padmin" class="form-control" id="pwd">
     </div>
     <input type="hidden" name="tokenn" value=<?php echo Token::genarate();   ?> >
     
    <button type="submit" name="addadmin" class="btn btn-success">Add</button>
     </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title " id="exampleModalLabel">Delete confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are You Sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form method="POST" action="">
            <input type="hidden" name="token" value=<?php echo Token::genarate();   ?> > 
            <button type="submit" name="del" id="deleteButton" class="btn btn-primary">Yes</button>
           </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

