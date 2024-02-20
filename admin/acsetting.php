<?php
include("component/session.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Setting</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/favicon.ico" />
    <style type="text/css">
      
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- link: navbar.html -->
       <?php include("component/navbar.php"); ?>
      <div class="container-fluid page-body-wrapper">
        <!-- link: sidebar.html -->
       <?php include("component/sidebar.html"); ?>
       <!-- content area -->
        <div class="main-panel">
          <div class="content-wrapper">
<!-- -----------------------------------content area-------------------------------------------------->
            
          <div class="row">
             <div class="col-12">
                <div class="card">
                  <h4 style="margin-top: 20px; margin-left:10px;">Account Details</h4><hr>
                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6">
                       <form method="POST">
                              <?php
                                      include 'database/db_con.php';
                                      $ac_res = mysqli_query($conn,"select * from user where id = ".$_SESSION['id']." ;");
                                      $ac_row = mysqli_fetch_row($ac_res);


                                      if(isset($_POST['updateac']))
                                      {
                                          if ($_POST['uname']!="" and $_POST['city']!="") {
                                            mysqli_query($conn,"update user set name='".$_POST['uname']."', address='".$_POST['city']."' where id=".$_SESSION['id'].";"); 
                                            echo '<script> window.location.replace("acsetting.php");</script>';
                                          }
                                      }
                              ?>

                              <h6 style=" margin-top: 0px; font-size: 14px; "> User Name:</h6>
                              <input type="text" class="form-control" name="uname" maxlength="15" placeholder="Enter Your Name" value="<?php echo $ac_row[3];?>"/>

                              <h6 style=" margin-top: 10px; font-size: 14px;"> Number:</h6>
                              <input type="text" class="form-control" name="listname" placeholder="Enter Your Number" disabled value="<?php echo $ac_row[1];?>"/>

                              <h6 style=" margin-top: 10px; font-size: 14px;"> City:</h6>
                              <input type="text" class="form-control" name="city" placeholder="Enter Your City" value="<?php echo $ac_row[6];?>"/>

                              <br>
                               <button type="submit" class="btn btn-gradient-primary me-2" name="updateac">Submit</button>
                               
                            </form>
                      </div>


                       <div class="col-md-6" style="padding:50px;">
                            <center>
                               <?php
                                  if (isset($_POST['imgupload'])) {
                                    if($_POST['imgup'] == "")
                                    {
                                      echo '<span style="color:red;">please select image</span>';
                                    }
                                    else
                                    {
                                      
                                    }
                                  }
                                ?>
                            <form id="fr" method="POSt">
                            <img width="80px"  src="assets/images/farmer.png"/>
                            <br>
                            <input type="file" class="ipu" name="imgup" placeholder="Upload Image" accept="image/*">
                            <br><br>
                            <button type="submit" class="btn btn-gradient-danger me-2" name="imgupload">Upload</button>
                            </form>
                            </center>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
          </div>

<!-- ----------------------------------- end content area-------------------------------------------------->
          </div>
          <!-- link: footer.html -->  
          <?php include("component/footer.php"); ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   <?php include("component/js.html"); ?> 
  </body>
</html>