<?php
  include("component/session.php");
  if (isset($_REQUEST['msg'])) {
    $msg="labour added..";
  }
  if (isset($_POST["insert"])) {
       $name=$_POST['name']; $number=$_POST['number']; $add=$_POST['add']; $city=$_POST['city']; $gender=$_POST['gender'];
      if($name != "" And $gender != "" And $number != "" And $add != "" And $city != "")
      {
            if (strlen($number) > 9) {
            include("database/db_con.php");
            $qry = "INSERT INTO `labours` VALUES (NULL, ".$_SESSION['id'].", '".$_SESSION['userdb']."', '".$name."', '".$add."', '".$city."', '".$number."', '".$gender."', current_timestamp());";
            
            mysqli_query($conn,$qry);
            header("location: newlab.php?msg=ok");
            }else{$msg="number is not valid";}
      }
      else {
        $msg= "please fill all fields..";
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab Man</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/favicon.ico" />
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
           <h6 style="color:red; padding: 10px"> <?php  if(isset($msg))echo $msg; ?></h6>
             <div class="col-12 grid-margin stretch-card">

                <div class="card">

                  <div class="card-body">

                    <h4 class="card-title">ADD NEW LABOUR</h4>
                    <p class="card-description"> fill the required information.. </p>

                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="full Name" name="name" value="<?php  if(isset($name))echo $name; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Contact</label>
                        <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Number" name="number" value="<?php  if(isset($number))echo $number; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Address</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Address" name="add" value="<?php  if(isset($add))echo $add; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender" name="gender" required>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputCity1">City</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location" name="city" value="<?php  if(isset($city))echo $city; ?>" required>
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary me-2" name="insert">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>


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