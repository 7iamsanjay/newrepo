<?php
include("component/session.php");
    if(isset($_POST['btndel']))
      {
        include ("database/db_con.php");

        $lab = mysqli_fetch_row(mysqli_query($conn,"SELECT count(lid) from ".$_SESSION['userdb']." where lid=".$_GET['delete'].";"));

        if($lab[0] == 0)
        {
          mysqli_query($conn,"DELETE FROM labours WHERE lid=".$_GET['delete']."");
          header("location: labours.php");
        }
        else{$errormsg = " Can't Delete.. (".$lab[0].") Records found in List's ";}
      }


      //edit btn starts
      if(isset($_GET['edit']))
      {
        include ("database/db_con.php");

          $linfo = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM labours WHERE lid={$_GET['edit']}"));
      }
      //edit btn ends
      if (isset($_POST["insert"])) {
       $name=$_POST['name']; $number=$_POST['number']; $add=$_POST['add']; $city=$_POST['city']; $gender=$_POST['gender'];
      if($name != "" And $gender != "" And $number != "" And $add != "" And $city != "")
      {
            if (strlen($number) > 9) {
            include("database/db_con.php");
            $qry = "UPDATE labours SET name='".$_POST['name']."',address='".$_POST['add']."',location='".$_POST['city']."',number='".$_POST['number']."',gender='".$_POST['gender']."' WHERE lid = ".$_GET['edit']." ;";
            
            mysqli_query($conn,$qry);
            mysqli_query($conn,"UPDATE ".$_SESSION['userdb']." SET name='".$_POST['name']."' WHERE lid=".$_GET['edit'].";");
            header("location: ?msg=updated");
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
    <title>Lab-Man</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/favicon.ico" />
    <style type="text/css">
      .delete{width: 98%; display: flex; margin: 10px; background-color:  #f9e79f ; position: relative; }
      .r1{ background-color: #f1c40f ; padding: 2px;  }
      .r1 img {width: 60px; margin: 5px;}
      .msg{position: absolute; top: 60%; left: 50%; transform: translate(-50%,-50%);}
      .msg p {font-family: "Lucida Console", "Courier New", monospace; width: 100%;}
      .msg button{background-color: #0000; border: none; background: white; margin-left: 10px; border-radius: 2px; padding: 2px 7px; color: ; font-weight: bold; transition: 0.7s;}
      .msg button:hover{background-color: #0000; color: ; border: 1px solid black;}
      .edit{width: 100%; height: 100vh;}
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
<!-- ---------------------delete btn start ------------------------------------------------------ -->        
        <div class="delete" style="display:<?php if(!isset($_GET['delete'])) echo "none";?>;">
          <div class="r1"> <img src="assets/images/ui/warning.png"></div>
         <form method="POST"> <div class="msg"><?php if(isset($errormsg)) echo $errormsg.'<a href="labours.php">Cancel</a>';?>
          <p style="display:<?php if(isset($errormsg)) echo "none";?>;"><span>Confirm:</span> Are You Sure <button onclick="submit" name="btndel"><i class="mdi mdi-delete"></i>DELETE</button></p>
          </div></form>
        </div>
<!-- ---------------------delete btn ends ------------------------------------------------------ -->
<!-- ---------------------edit btn start ------------------------------------------------------ -->
        <div class="row" style="display:<?php if(!isset($_GET['edit'])) echo "none";?>;">

                      <h6 style="color:red; padding: 10px"> <?php  if(isset($msg))echo $msg; ?></h6>

             <div class="col-12 grid-margin stretch-card">

                <div class="card">

                  <div class="card-body">

                    <h3 class="card-title">Update Labour Detail</h3>
                    <p>WARNING : After Update Information All List Also Updated... </p>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="full Name" name="name" value="<?php  echo $linfo[3]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Contact</label>
                        <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Number" name="number" value="<?php echo $linfo[6]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Address</label>
                        <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Address" name="add" value="<?php  echo $linfo[4];?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender" name="gender">
                          <option value="male">Male</option>
                          <option value="female" <?php if($linfo[7] == "female") echo "SELECTED"?>>Female</option>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputCity1">City</label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location" name="city" value="<?php echo $linfo[5]; ?>">
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary me-2" name="insert">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>


        </div>
<!-- ---------------------edit btn ends ------------------------------------------------------ -->

<!-- -----------------------------------content area-------------------------------------------------->
            
          <div class="row" style="display:<?php if(isset($_GET['delete']) or isset($_GET['edit'])) echo "none";?>;">
                <div class="col-lg-12 grid-margin stretch-card" >
                <div class="table-responsive" style="width: 100%; background: white; box-shadow: 5px 3px 20px  black; border-radius: 6px;">
                  <?php if(isset($_GET['msg'])) echo '<h4 style="margin:2px;">'.$_GET['msg'].'</h4>';?>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Gender </th>
                          <th> First name </th>
                          <th><center> Action </center></th>
                          <th> Progress </th>
                          <th> Number </th>
                          <th> Location </th>
                        </tr>
                      </thead>
                      <tbody>
<!----------------------------------------print table---------------------------------------------------->
                        <?php

                            include("database/db_con.php");
                            $res = mysqli_query($conn,"SELECT * FROM labours WHERE uid='".$_SESSION['id']."' AND userdb='".$_SESSION['userdb']."';");
                            $progress =array("success","danger","primary","warning","info"); $progno = 0;
                                while($row = mysqli_fetch_assoc($res))
                                {
                                      if($progno > count($progress))
                                        $progno = 0;
                                      if($row['gender'] == "female")
                                        $pic="pic-3.png";
                                      else
                                        $pic="pic-4.png";
                                      echo '<tr>
                                            <td class="py-1">
                                            <img src="assets/images/faces-clipart/'.$pic.'" alt="image" />
                                            </td>';
                                      $progcount = mysqli_fetch_row(mysqli_query($conn,"SELECT count(lid) from ".$_SESSION['userdb']." WHERE lid=".$row['lid'].";"));
                                      $listcount = mysqli_fetch_row(mysqli_query($conn,"SELECT count(DISTINCT(listid)) from ".$_SESSION['userdb'].";"));
                                      $progcount = (int) $progcount[0]; 
                                      $listcount = (int) $listcount[0]; 
                                      $progwidth = ($progcount*100)/$listcount;
                                      //(list*100/lid)
                                      echo '<td> '.$row["name"].' </td>
                                            <td><center> <img src="assets/images/ui/find.png"></img><a href="?edit='.$row['lid'].'"><img src="assets/images/ui/edit.png" style="margin:0px 10px;"></img></a><a href="?delete='.$row['lid'].'"><img src="assets/images/ui/eraser.png"></img></a> </center></td>';
                                      echo '<td>
                                            <div class="progress">
                                            <div class="progress-bar bg-'.$progress[$progno].'" role="progressbar" style="width: '.$progwidth.'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </td>
                                            <td> '.$row["number"].' </td>';
                                      echo  '
                                            <td> '.$row["location"].' </td>
                                             </tr>';
                                      $progno++;
                                }

                        ?>
<!-----------------------------------end of print table-------------------------------------------------->
                      <!--  <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                          </td>
                          <td> Herman Beck </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 77.99 </td>
                          <td> May 15, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-2.png" alt="image" />
                          </td>
                          <td> Messsy Adam </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $245.30 </td>
                          <td> July 1, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-3.png" alt="image" />
                          </td>
                          <td> John Richards </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $138.00 </td>
                          <td> Apr 12, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-4.png" alt="image" />
                          </td>
                          <td> Peter Meggik </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-primary"  role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 77.99 </td>
                          <td> May 15, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                          </td>
                          <td> Edward </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 160.25 </td>
                          <td> May 03, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-2.png" alt="image" />
                          </td>
                          <td> John Doe </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 123.21 </td>
                          <td> April 05, 2015 </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="assets/images/faces-clipart/pic-3.png" alt="image" />
                          </td>
                          <td> Henry Tom </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> $ 150.00 </td>
                          <td> June 16, 2015 </td>
                        </tr>-->

                         
                      </tbody>
                    </table>
                  
                </div>
              </div>

          </div>
         <!-- <div class="row">
              <div class="col-lg-12 grid-margin stretch-card" style="background-color: white; border-radius: 10px;">
                    <table style="width:100%;">
                    <tr><td><center><img src="assets/images/faces-clipart/pic-3.png" alt="image" /></center></td>
                         <td colspan="2">Anil Jadav vijaybhai</td>
                         
                        <td><center><div class="progress" style="width: 70%;">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div></center>
                        </td>
                       
                    </tr>
                    <tr>
                      <td><center>male</center></td>
                      <td>dudhala</td>
                      <td>7874492990</td>
                      <td><center> <img src="assets/images/ui/find.png" style="width: 35px;"></img><img src="assets/images/ui/edit.png" style="width: 35px;"></img><img src="assets/images/ui/eraser.png" style="width: 35px;"></img> </center></td>

                    </tr>

                  </table>
              </div>
          </div>-->


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