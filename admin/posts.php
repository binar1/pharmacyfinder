<?php require_once '../init.php';
$admin=new Admin();
if (!$admin->isLoggedIn()) {
	Redirect::to('index.php');
}
if(isset($_POST['del'])){
if(Token::checkManual(Input::get('tokenn'),'tokenn')){

$bool= $admin->deleteOnePost($_POST['del']);
if($bool){
    header("Location:posts.php");

}else{
  echo "false";
}
}
}

if(isset($_POST['approve'])){
    if(Token::checkManual(Input::get('token'),'token')){
    
        $anjam= $admin->updateInfo('medicine',array('status'=>1),Input::get('approve'));
        if($anjam){
            header("Location:pharmacy.php");

        }
    
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
<h2 class="h2 text-center" style="color:white;">Posts Page</h2>
</div>

<div class="container-fluid">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">effect</th>
      <th scope="col">cost|price</th>
      <th scope="col">posted_at</th>
      <th scope="col">pharmacy</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    $data=$admin->getAllPosts();
  
    for($i=0;$i<count($data);$i++){
  
  ?>
    <tr>
      <th scope="row"><?php echo $i+1; ?></th>
      <td><?php echo $data[$i]['name']; ?></td>
      <td><?php echo $data[$i]['advantage'];?></td>
      <td><?php echo $data[$i]['cost'];?></td>
      <td><?php echo $data[$i]['created_at'];?></td>
      <td><?php echo $data[$i]['pharmacy'];?></td>
      <td>
     
      <?php if(!$data[$i]['status']){ ?>
  
      <button  class="btn btn-outline-success "   data-toggle="modal" data-target="#exampleModal2" value="<?php echo  $data[$i]['id']; ?>"   onclick="approve('<?php echo  $data[$i]['id']; ?>')"><i class="fa fa-thumbs-up" aria-hidden="true"></i>approve</button>
      <?php  } ?>
    
      </td>
      <td>
    
     
      <button class="btn btn-outline-danger "  data-toggle="modal" data-target="#exampleModal" value="<?php echo  $data[$i]['id']; ?>"   onclick="data('<?php echo  $data[$i]['id']; ?>')"><i class="fa fa-trash"></i> Trash</button>
  
      <a class="btn btn-outline-info "  href="../include/EventDetail.php?number=<?php echo  $data[$i]['id']; ?>" target="_blank"  ><i class="fa fa-paper-plane" aria-hidden="true"></i> see Post
</a>
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
function approve(data){
document.getElementById('approveButton').value=data;
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
      <div class="modal-header bg-success">
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
            <input type="hidden" name="token" value=<?php echo Token::genarateManual('token');   ?> >
            <button type="submit" name="approve" id="approveButton" class="btn btn-primary">Yes</button>
           </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

