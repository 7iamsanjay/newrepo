<?php 
session_start();
    if(isset($_POST['Submit']))
    {
         if(strlen($_POST['phone']) == 10){        
             if(strlen($_POST['Password']) > 5){      
                              include("database/db_con.php");
                              $phone = $_POST['phone'];
                              $Password = $_POST['Password'];
                              $qry = "SELECT phone,password,id,name,dbname FROM user WHERE phone='".$phone."' AND password='".$Password."';";
                              
                              $ver = mysqli_fetch_row(mysqli_query($conn,$qry));
                              if(isset($ver[0]))
                              {
                                if($ver[0] == $phone and $ver[1] == $Password)
                                {
                                echo "succesfull";
                                  mysqli_query($conn,"UPDATE user SET last_login=current_timestamp() WHERE id=".$ver[2].";");
                                  $_SESSION["id"] = $ver[2];
                                  $_SESSION["name"] = $ver[3];
                                  $_SESSION["userdb"] = $ver[4];

                                  echo $_SESSION["userdb"];
                                  header("location: Admin.php");
                                }
                                else
                                  echo "failed";
                              }
                              else
                              {
                                $msg = "invalid user name or password";
                                session_destroy();
                              }
                   }else{
                       $msg =  "enter password at least 6 character...";
                   }

            }else{
                $msg =  "invalid number (10 digit required)";
              }
      
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Man</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img 	src="assets/images/logo2.png">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="number" minlength="10" maxlength="10" name="phone" class="form-control form-control-lg" id="exampleInputphone1" placeholder="phone number">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="Password" placeholder="Enter Password" required>
                  </div>
                  <span style="color: red;"><?php if(isset($msg)) echo $msg;?></span>
                  <div class="mt-3">
                    <input type="Submit" name="Submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN"/>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                       <!-- <input type="checkbox" class="form-check-input"> Keep me signed in </label>-->
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                 
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script 	src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script 	src="assets/js/off-canvas.js"></script>
    <script 	src="assets/js/hoverable-collapse.js"></script>
    <script 	src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>