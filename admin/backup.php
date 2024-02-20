<?php
  if(isset($_POST['signin']))
  {
    $name = $_POST['name'];
    $passworr = $_POST['passworr'];
    $email = $_POST['email'];
    $add = $_POST['add'];
    echo $name.$passworr.$email;
    if($name != "" and $passworr != "" and $email != "" and $add != "")
    {
    //-------------------------------Registetion process-------------------------------------
      
        if($name != "")
        {
                include("database/db_con.php");
                $res = mysqli_query($conn,"INSERT INTO user 
                  Values(null,'".$email."','".$passworr."','".$name."','A',null,'".$add."',current_timestamp(),current_timestamp(),'empty');");

                   $qry = "SELECT id,name,gmail FROM user WHERE gmail='".$email."' AND passworr='".$passworr."';";
                   $ver = mysqli_fetch_row(mysqli_query($conn,$qry));
                     if(isset($ver[0]))
                      {
                          $tabname = $ver[0].substr($ver[2],0,4);
                          $tabname = str_replace(' ','',$tabname);

                          $table = "CREATE TABLE ".$tabname." (
                                    id int(11) PRIMARY KEY AUTO_INCREMENT,
                                    listid int(11) NOT NULL,
                                    lid int(11) NOT NULL,
                                    listname varchar(100) NOT NULL,
                                    name varchar(100) NOT NULL,
                                    location varchar(20) NOT NULL,
                                    work varchar(20) NOT NULL,
                                    amt float NOT NULL,
                                    status varchar(11) NOT NULL,
                                    pdate  date,
                                    ldate date);";

                            echo $table;
                             mysqli_query($conn,$table);
                             mysqli_query($conn,"UPDATE user SET dbname='".$tabname."' WHERE id=".$ver[0].";");
                            header("location: login.php");
                            echo $tabname;
                        }
          }else{$msg="invalid name  - ".substr($email, 0,4);}
    //---------------------------------------------------------------------------------------
    }else
    {
      $msg = "empty fields...";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
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
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="assets/images/logo.svg">
                </div>
                <h4>New here?</h4><?php if(isset($msg)) echo $msg;?>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Name" name="name">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                  </div>
                    <div class="form-group">
                    <input type="passworr" class="form-control form-control-lg" id="exampleInputpassworr1" placeholder="password" name="passworr">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Address" name="add">
                  </div>
                                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>

                  <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="SIGN UP" name="signin" />
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
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
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>