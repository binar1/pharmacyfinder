<?php require_once '../init.php';
$user=new User();
$admin =new Admin();
if (!$admin->isLoggedIn()) {
	Redirect::to('index.php');
}
if(isset($_POST['del'])){

    if(Token::checkManual(Input::get('tokenn'),'tokenn')){
    $bool= $admin->deleteuserposts($_POST['del']);
   echo $bool;
    if($bool){
        $booll= $admin->deleteuser($_POST['del']);

        if($booll){
            header("Location:pharmacy.php");
        }else{
            echo "false"."2";
        }
    }else{
      echo "false";

}
}
}

if(isset($_POST['verifybtn'])){
   
    if(Token::checkManual(Input::get('tokenverify'),'tokenverify')){
      
        $anjam= $admin->updateInfo('user',array('verify'=>Input::get('verify')),Input::get('verifybtn'));
        if($anjam){
            header("Location:pharmacy.php");

        }
    }



  }
  
  if(isset($_POST['unverifybtn'])){
      if(Token::checkManual(Input::get('tokenunverify'),'tokenunverify')){
      
        $anjam= $admin->updateInfo('user',array('verify'=>Input::get('unverify')),Input::get('unverifybtn'));
        if($anjam){
            header("Location:pharmacy.php");

        }
    }
}          

  ?>




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
<h2 class="h2 text-center" style="color:white;">Pharmacy Page</h2>
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
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $data=$user->getAllPharmacy();
  
    for($i=0;$i<count($data);$i++){
  
  ?>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $data[$i]['name']; ?></td>
      <td><?php echo $data[$i]['email'];?></td>
      <td><?php echo $data[$i]['address'];?></td>
      <td>
       <input type="hidden" value="<?php echo $data[$i]['verify'];  ?>"/>
      <?php if(!$data[$i]['verify']){?>
      <button class="btn btn-outline-info " onclick="data('<?php echo  $data[$i]['id']; ?>','1')" data-toggle="modal" data-target="#exampleModal2" value="<?php echo  $data[$i]['id']; ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
       verify</button>
        <?php
        } 
      ?>

<?php if($data[$i]['verify']){
            ?>
        
      <button class="btn btn-outline-danger " onclick="data('<?php echo  $data[$i]['id']; ?>','0')"  data-toggle="modal" data-target="#exampleModal3" value="<?php echo  $data[$i]['id']; ?>"   ><i class="fa fa-thumbs-down" aria-hidden="true"></i>unverify
         </button>
            <?php
        } ?>


      </td>
      <td>
      <button class="btn btn-outline-danger " data-toggle="modal" data-target="#exampleModal" value="<?php echo  $data[$i]['id']; ?>"   onclick="remove('<?php echo  $data[$i]['id']; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>remove
</button>
<a class="btn btn-outline-success "  href="../include/ProfileOrganization.php?profile=<?php echo  $data[$i]['id']; ?>" target="_blank"  ><i class="fa fa-user" aria-hidden="true"></i> see profile
</a>
      </td>
    </tr>
    <?php   }  ?>
  </tbody>
</table>
</div>
<script>
 function data(data,statue){
if(statue=='0'){
document.getElementById('unverifybtn').value=data;
document.getElementById('unverify').value=statue;
}
if(statue=='1'){
document.getElementById('verifybtn').value=data;
document.getElementById('verify').value=statue;
}  
}

function remove(data){
document.getElementById('deleteButton').value=data;
}
</script>


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
            <input type="hidden" name="tokenn" value=<?php echo Token::genarateManual('tokenn');   ?> > 
            <button type="submit" name="del" id="deleteButton" class="btn btn-primary">Yes</button>
           </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title " id="exampleModalLabel">approve confirm</h5>
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
            <input type="hidden" name="verify" id="verify" >       
            <input type="hidden" name="tokenverify" value=<?php echo Token::genarateManual('tokenverify');   ?> > 
            <button type="submit" name="verifybtn" id="verifybtn" class="btn btn-primary">Yes</button>
           </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title " id="exampleModalLabel">unapprove confirm</h5>
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
            <input type="hidden" name="tokenunverify" value=<?php echo Token::genarateManual('tokenunverify');   ?> >
            <input type="hidden" name="unverify" id="unverify" >
            <button type="submit" name="unverifybtn" id="unverifybtn" class="btn btn-primary">Yes</button>
           </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

