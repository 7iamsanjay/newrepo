<?php
include("component/session.php");
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
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
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

          <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">

                  <div class="card-body">
                  <?php


                            if(isset($_POST["srtbtn"]))
                              {
                                if($_POST['sort'] == 'd'){
                                $condition = " AND tdate like '".date("Y-m-d")."'";
                                
                               }else if($_POST['sort'] == 'm'){
                                $condition = " AND (tdate >= '".date("Y-m")."-01') " ;
                                
                               }else if($_POST['sort'] == 'y'){
                                $condition = " AND (tdate > '".date("Y")."-01-01' OR tdate like '".date("Y")."-01-01')" ;
                                
                               }else if($_POST['sort'] == 'a'){
                                $condition = "" ;
                                
                               }else{$condition ="";}
                              }
                              else{$condition = " AND (tdate >= '".date("Y-m")."-01') " ;  }
                  ?>
                  <table width="100%"><tr>
                    <td><h4 class="card-title">Transactions</h4></td>
                     <td align="right"><form method="POST" >
                                    
                                    <span style="color:#7d3c98; margin-left:10px;">Sort:</span>
                                    <select id="gets" name="sort" style="color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background-color:#0000;" >
                                    <option value="d">DAY</option>
                                    <option value="m" selected>MONTH</option>
                                    <option value="y">YEAR</option>
                                    <option value="a">ALL</option>
                                    </select>
                                    <input type="submit" name="srtbtn" value="SORT" style="color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background: #0000;"/>
                                </form></td></table>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> List name </th>
                          <th> Labour name </th>
                          <th> Amount </th>
                          <th> Date </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          include ("database/db_con.php");
                          $qr = mysqli_query($conn,"select * from transaction where dbname='".$_SESSION['userdb']."' ".$condition." order by tid desc;");
                          while($res = mysqli_fetch_assoc($qr))
                          {
                            echo "<tr>";
                            echo '<td>'.$res["listname"].'</td>';
                            echo '<td>'.$res["lname"].'</td>';
                            echo '<td>'.$res["amt"].'</td>';
                            echo '<td>'.$res["tdate"].'</td>';
                            echo "</tr>";
                          }
                        ?>
                      </tbody>
                    </table>
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