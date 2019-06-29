 <!-- Static navbar -->
 <?php require_once '../init.php'; ?>
 
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">pharmacy finder</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admins.php">Show Admins</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Pharmacy.php">pharmacy</a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->

    </ul>
    <?php
            // $member=new Admin(); 
           
            // if($member->isLoggedIn()){
              
              ?>
    <ul class="nav navbar-nav navbar-right">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="../images/Profile.png" width="25px" height="25px" style="margin-right:10px;margin-left:10px;">  Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
              <a href="Logout.php" class="dropdown-item"><img src="../images/logout.png" width="25px" height="25px" style="margin-right:10px;margin-left:10px;">Log Out</a> 
      </li>
    </ul>
    <?php #} ?> 
  </div>
</nav>
 
