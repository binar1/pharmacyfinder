<?php require_once '../init.php';
  $event=new Event();
 ?>
<?php 
 if (Input::exist()) {
       $validation=new ValidationMember();
       $organization=new User(); 
       $validation->check($_POST,array(
       	'title' => array('require' => 'true' ,'min' =>4 ),
       	'eventDescription' => array('require' => 'true' ,'min' =>4 ),
       	'Price' => array('require' => 'true','less'=>0),
       	'Number' => array('require' => 'true','less'=>0),
       	 ));   
   
   if ($validation->passed()) {
   	if (Token::check(Input::get('token'))) {
   	    $id=$organization->data()->id;

         try {
      
         	$elements=array(
         		'name'=>Input::get('title'),
         		'advantage'=>Input::get('eventDescription'),
         		'cost'=>Input::get('Price'),
         		'quantity'=>Input::get('Number'),
         		'created_at'=>date('Y-m-d H:i:s'),
         		'img'=>$organization->ImagesPrepare($_FILES['image'],"posts/"),
         		'id_user'=>$id,
         		'catagorey_id'=>Input::get('catagorey'));
         	
         	$event->addEvent('medicine',$elements);
         } catch (Exception $e){
         	die($e->getMessage());
         }
    	}else
    	{
    		echo "token pewista";
    	}
    	    

    	}else {
    		foreach ($validation->errors() as $error) {
				echo "<div class='alert alert-danger alert-dismissible' style='width:400px;margin-left:38%;margin-top:10%;position:absolute;'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<p style='font-size:15px;text-transform:capitalize;' align='center'><p> $error<br>
			   </p></div>";
    		}
    	} 	
 }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	.linedit{
		margin-top: 80px;
		width: 60px;
		height: 40px;
		text-align: center;
		font-size: 20px;
		background-color: skyblue;
	}
	form input[type="date"]{
		width: 110px;
		display: inline;
	}
	form input[type="time"]{
		width: 110px;
		display: inline;
	}
	div a .imagee:hover{
		background-color: lightcyan;
		padding: 30px;
	}
	.ticket{
		margin-top: 60px;
		text-align: center;
	}
</style>
<body>
	<?php include ('Header.php');?>
	<p id="goo"></p>
	<div class="container" style="background-color: whitesmoke;">
		<input class="btn-primary linedit" type="button" readonly disabled value="1">
		<h3 style="display: inline; margin-left: 10px;"></h3>
		
		<form style="margin-top: 40px;" class="form-inline" method="POST" enctype=multipart/form-data action="" >
		<div>
		    <label for="ED">medicen Title:</label>
		    <input type="text" class="form-control" id="ED" name="title" placeholder="Give it a Title" style="width:80%;">
		</div>
		<br>
	   <br>
	
		<br>
	    
		
    	<div class="form-group">
      	<h4 style="margin-top: 50px;">medicen DESCCRIPTION</h4>
      	<textarea class="form-control" name="eventDescription" rows="5" placeholder="write about your event" cols="100"></textarea>
   	 	</div>
   	 	<br><br>
   	 	<div class="form-group">
			<h4>choose medicen Catagorey</h4>
			<div class="input-group">
			<select class="form-control" style="width:200px;border-radius:10px;" name="catagorey">
			<?php $db=DB::getInstance();
			      $res=$db->query("select * from catagorey");
			      if ($res->count()>0) {
			      foreach ($res->result() as $ones) {
			   ?>	
			
	    	<option value=<?php echo $ones->catagorey_id; ?>><?php echo $ones->name ?></option>
	   
	    <?php
	       }}
			  ?>
			   </select>	
			</div>
	    		
		</div>
		<br><br>
   	 	
   	 	<br>

		<input class="btn-primary linedit" type="button" readonly disabled value="2">
		<h3 style="display: inline; margin-left: 10px;"></h3>
		<div class="ticket" style="margin-bottom:20px;">
			<h4>Write Your Medicen Ticket Price In Dollar If Its Free Just Write 0:</h4>
			<div style="margin-top: 30px;">
			  	<input type="number" min="0" name="Number" class="btn btn-default" placeholder="Number Item" >
			  	<input type="number" min="0" name="Price" class="btn btn-default" placeholder="Price In Dollar" >
			</div>
		</div>
		<h4 style="margin-top: 50px;">Medicen IMAGE</h4>
		<div class="form-group" style="margin-left:150px;margin-top:-50px;">
	    	
	      <input type="file" name="image" style="position:absolute;margin-top:5px;opacity:0" >
	      <input type="button" name="Browse" class="btn btn-primary" value="Choose"> 

		</div>
		<br>
		<div style="margin-left: 400px;margin-top:20px; margin-bottom: 30px;">
		<div style="margin-left: 150px;">
		<input type="hidden" name="token" value=<?php echo Token::genarate(); ?>>
		<input type="submit" class="btn btn-success" name="finish" style=" height: 40px;" value="Submit" />
		</div>

		
	</div>
</form>
	</div>
       
	
	<?php include 'Footer.php'; ?>
</body>
</html>
