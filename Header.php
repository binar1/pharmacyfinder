 <!-- Static navbar -->
 <div class="container-fluid">
    <nav class="navbar navbar-fixed-top navbar-expand-sm navbar-inverse bg-dark" style="width:100%;margin:0;padding:0;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">pharmacy finder</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li  class='active'
             ><a href="index.php">Home</a></li>
            <li><a href="include/allpharmacy.php">All pharmacy</a></li>
            <li><a href="include/mapPharmacy.php">Map</a></li>
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            $member=new User(); 
            if($member->isLoggedIn()){ ?>
             <li  style="font-weight:bold;">
              <a href="include/Profile.php"><?php if($member->data()->img){ echo "<img src=images/Profile/".$member->data()->img." width='30px' height='30px' style='margin-right:10px;border-radius:50px;'>"; }else{ echo "<img src=images/Profile.png  width='25px' height='25px' style='margin-right:10px;border-radius:50px;'>";}?>Profile <span class="sr-only">(current)</span></a></li>
            <li>
              <a href="include/Logout.php"><img src="images/logout.png" width="25px" height="25px" style="margin-right:10px;margin-left:10px;">Log Out</a></li>
         <?php   }else{
              ?>
            <li class="active" style="font-weight:bold;">
              <a href="include/Login.php">Log In <span class="sr-only">(current)</span></a></li>
            <li>
              <a href="include/Register.php">Sign Up</a></li>
       <?php } ?>   </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    </div>