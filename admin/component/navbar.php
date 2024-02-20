<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="Admin.php"><img src="assets/images/logo1.png" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="Admin.php"><img src="assets/images/ledger.png" style="width:30px;" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <div class="search-field d-none d-md-block">
      <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
        </div>
      </form>
    </div>
    <ul class="navbar-nav navbar-nav-right">
        
        <li class="nav-item">
       <a class="nav-link" href="Admin.php">
          <i class="mdi mdi-home"></i>    
        </a>
      </li>      
     
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email-outline"></i>
          <span class="count-symbol bg-warning"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0">Messages</h6>
        
            <?php

                include("database/db_con.php");
                
                $resmsg = mysqli_query($conn,"select * from msg where reciver='".$_SESSION['userdb']."' or sender='labman';");
                $msgcount = 1;
                while($msgrow = mysqli_fetch_assoc($resmsg))
                {
                  echo '<div class="dropdown-divider"></div>';
                  echo '<a class="dropdown-item preview-item" href="msg.php">
                        <div class="preview-thumbnail">
                          <img src="assets/images/faces-clipart/pic-4.png" alt="image" class="profile-pic"/>
                          <center><p style="margin:0px; padding:0px;">'.$msgrow["sender"].'</p></center>
                        </div>  
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                          <h6 class="preview-subject ellipsis mb-1 font-weight-normal">'.$msgrow["title"].'</h6>
                          <p class="text-gray mb-0">'.$msgrow["date"].'</p>
                        </div>
                      </a>';
                      if($msgcount == 3)
                        break;
                      else
                        $msgcount++;
                    
                }

            ?>
          <div class="dropdown-divider"></div>
          <h6 class="p-3 mb-0 text-center"><a href="msg.php" style="text-decoration: none;">See All Messages</a></h6>
        </div>
      </li>
      <li class="nav-item dropdown" style="display:none;">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i>
          <span class="count-symbol bg-danger"></span>
        </a>
        <div  class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0">Notifications</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="mdi mdi-calendar"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
              <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="mdi mdi-settings"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
              <p class="text-gray ellipsis mb-0"> Update dashboard </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="mdi mdi-link-variant"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
              <p class="text-gray ellipsis mb-0"> New admin wow! </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <h6 class="p-3 mb-0 text-center">See all notifications</h6>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="<?php 
            $imgqry = mysqli_query($conn,"select img from user where dbname='".$_SESSION['userdb']."';");
            $imgres = mysqli_fetch_row($imgqry);
            if($imgres[0] != "")
              echo $imgres[0];
            else
              echo 'assets/images/farmer.png';
            ?>" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black"><?php echo $_SESSION['name']; ?></p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          
          <div class="dropdown-divider"></div>
          <form method="POST"> <button class="dropdown-item" name="logout">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout </button></form>
           <div class="dropdown-divider"></div>
           <a href="acsetting.php" class="dropdown-item">
           <i class="mdi mdi-account-settings me-2 text-warning"></i> Account</a>
        </div>
      </li>
     <!-- <li class="nav-item nav-logout d-none d-lg-block">
       <a class="nav-link" href="#" name="logout">
          <i class="mdi mdi-power"></i>
        </a>
      </li>--
      <li class="nav-item nav-settings d-none d-lg-block">
        <a class="nav-link" href="">
          <i class="mdi mdi-format-line-spacing"></i>
        </a>
      </li>-->
       <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>