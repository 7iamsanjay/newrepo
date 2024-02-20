<?php
    include("component/session.php");
  include("database/db_con.php");

  if(isset($_GET["pay"]))
  {
    mysqli_query($conn,'UPDATE '.$_SESSION['userdb'].' SET status="PAID",pdate="'.date('Y-m-d').'" WHERE id='.$_GET['pay'].';');
    $qryget = mysqli_query($conn,'select amt,lid,name,listid,listname,id,count from '.$_SESSION["userdb"].' where id = '.$_GET["pay"].';');
    $resget = mysqli_fetch_row($qryget);
    $tamt = $resget[0]*$resget[6];
    mysqli_query($conn,"insert into transaction values(null,'".$_SESSION['userdb']."',".$resget[1].",".$resget[3].",'".$resget[4]."','".$resget[2]."',".$tamt.",".$resget[5].",'".date('Y-m-d')."');");
    header("location: ?view=".$_GET['pay']);
  }

  if(isset($_POST["payall"]))
  {
            if(isset($_POST['parry'])) 
            { 
                $lb = $_POST['parry'];
                foreach($lb as $LB)
                 {

                    mysqli_query($conn,'UPDATE '.$_SESSION['userdb'].' SET status="PAID",pdate="'.date('Y-m-d').'" WHERE id='.$LB.';');
                    $qryget = mysqli_query($conn,'select amt,lid,name,listid,listname,id,count from '.$_SESSION["userdb"].' where id = '.$LB.';');
                    $resget = mysqli_fetch_row($qryget);
                    $tamt1 = $resget[0]*$resget[6];
                    mysqli_query($conn,"insert into transaction values(null,'".$_SESSION['userdb']."',".$resget[1].",".$resget[3].",'".$resget[4]."','".$resget[2]."',".$tamt1.",".$resget[5].",'".date('Y-m-d')."');");
                 }
                 header("location: ?view=".$LB);
            }else{$msg = "no selections";}
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
  <style>
      addbtn{text-decoration: none; padding:15px 10px; margin-top: -58px; margin-right: -32px; border-radius: 10px; background-color: #7d3c98; border-left: 1px solid  #7d3c98; float: right; border-bottom: 1px solid  #7d3c98;color: white;}
      .addbtn{float:right; text-decoration:none; color: #7d3c98; padding:2px 25px; margin-right: 10px ; margin-top: 10px;  background-color:#0000; border:1px solid #7d3c98; border-radius:3px;}
      .paybtn{float:right; margin-top: 10px; text-decoration:none; color: #7d3c98; padding:2px 25px;  margin-right:22px; background-color:#0000; border:1px solid #7d3c98; border-radius:3px;}
      .paybtn img{width: 17px; margin-right: 2px;}
      .addbtn img{width: 17px; margin-right: 2px;}
      .editlist img{width: 20px; float: right; margin-right: -25px; margin-top: -47px;}
      .editlist a{padding: 30px;}
      .d-1{width:46%; margin:2%; background-color: white; border-radius: 4px; padding: 20px;}
    </style>
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
<!-- -----------------------content area -------------------------------------------------------------->

<?php 
            include("component/countblock.php");
        ?>
        <div class="row" style="display:<?php if(isset($_GET["add"])) echo "none";?>;">
            <div class="col-md-6">
              <div style="width:100%; display:flex;">
                <div class="d-1">
                <center>
                  Total List
                  <hr>
                  <?php echo$crow1[0];?>
                </center>
                </div>
                <div class="d-1">
                  <center>
                    total labour
                    <hr>
                    <?php echo$crow2[0];?>
                  </center>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div style="width:100%; display:flex;">
                <div class="d-1">
                <center>
                  UN-PAID AMOUNT
                  <hr>
                  ₹<?php echo$sum1;?>
                </center>
                </div>
                <div class="d-1">
                  <center>
                    PAID AMOUNT
                    <hr>
                    ₹<?php echo$sum;?>
                  </center>
                </div>
              </div>
            </div>
        </div>
            
             <div class="row">
              <?php

                if(isset($msg))
                  echo '<h5 style="color:red;">'.$msg.'</h5>';             
                 if(isset($_GET['list']))
                    $listcondition =  "WHERE listname='".$_GET['list']."'";
                else if(isset($_GET['view']))
                    $listcondition =  "WHERE id=".$_GET['view']." ";
                 else
                    $listcondition = "";


                $res = mysqli_query($conn,"SELECT listname,location,work,ldate FROM ".$_SESSION['userdb']." ".$listcondition." GROUP BY listname ORDER BY ldate DESC,id DESC;");
               
               // echo "--------SELECT listname,location,work,ldate FROM ".$_SESSION['userdb']." GROUP BY listname;";
                  while($row = mysqli_fetch_assoc($res)) 
                    {
                      $no = 1;
                     
                      $amt = 0;
                      $paid = 0;
                      $peddingg = 0;
                        
                        echo '<form method="POST">            
                        <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div clas="card-body" style="padding:20px;">
                            <h4 class="card-title"><span style="color:white; padding:5px 13px; border-radius:5px; background-color:#7d3c98;">'.$row["listname"].'</span></h4>
                            <p class="card-description"> Date:<span style="color: #7d3c98; padding:5px 10px;">'.$row["ldate"].'</span>
                               Location:<span style="color: #7d3c98; padding:5px 10px;">'.$row["location"].'</span>
                               Work:<span style="color: #7d3c98; padding:5px 10px;">'.$row["work"].'</span>
                            </p>
                            <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th> No </th>
                                  <th> Name </th>
                                  <th> Count </th>
                                  <th> Status </th>
                                  <th> Amount </th>
                                  <th> Total </th>
                                  <th> Action / date </th>
                                </tr>
                              </thead>
                              <tbody>';
                      //----------------------print records-----------------------
                      $res1 = mysqli_query($conn,"SELECT name,status,amt,pdate,id,count FROM ".$_SESSION['userdb']." WHERE listname='".$row["listname"]."';");
                      while($row1 = mysqli_fetch_assoc($res1))
                          {
                              $lname = $row1["name"];
                              if(strlen($lname)>20)
                              {
                                $lname = substr($lname,0,20)."..";
                              }
                              if($row1["status"]=="PENDDING")
                                  {
                                    $statuscolor = "danger";
                                    $peddingg = $peddingg + ($row1["amt"]*$row1["count"]);
                                  }
                              else
                                  {
                                   $statuscolor = "success";
                                   $paid = $paid + ($row1["amt"]*$row1["count"]);
                                  }
                              echo '<tr>
                                     <td >';
                                if($row1["status"]=="PENDDING")
                                  echo '<input type="checkbox" name="parry[]" value="'.$row1["id"].'"/> '.$no.'</td>'; 
                                else
                                  echo '<span style="margin-left:15px;">'.$no.'</td>';
                              echo '
                                    <td >
                                         '.$lname.'
                                    </td>
                                    <td> '.$row1["count"].' </td>
                                    <td >
                                      <label class="badge badge-gradient-'.$statuscolor.'">'.$row1["status"].'</label>
                                    </td>
                                    <td> ₹'.$row1["amt"].' </td>
                                    <td > ₹'.$row1["amt"]*$row1["count"].' </td>
                                    <td >';
                                  if($row1["status"]=="PENDDING")
                                     echo '<a href="?pay='.$row1["id"].'" > PAY</a> ';
                                  else 
                                      echo $row1["pdate"];

                               echo    '</td>
                                  </tr>';
                                  $no++;
                                  $amt+=$row1["amt"]*$row1["count"];
                          }

                                
                      //----------------------------------------------------------
                        echo ' </tbody>
                               </table>
                                </div>';
                        
                        echo  '</div><hr>';
                        if($peddingg != 0)       echo '<table><tr><td><input type="submit" class="btn-pay-all" name="payall" value="PAY SELECTED"></td><td><a class="btn-pay-all" style="float:right; text-decoration:none;" href="labpay.php?list='.$row['listname'].'">Labour Vise Pay</a></td></tr></table>';
                        echo ' 
                                <p class="card-description" style="margin-left:20px;">Paid:<span style="color: #7d3c98; padding:5px 10px;">₹'.$paid.'   </span>
                                     Pendding:<span style="color: #7d3c98; padding:5px 10px;">₹'.$peddingg.'</span>
                                     Total:<span style="color: #7d3c98; padding:5px 10px;">₹'.$amt.'</span>
                                     </p>';
                          
                        echo ' 
                               </div></div>';  
                        
                        echo '</form>';
                    }
              ?>
            </div>
            <!--------------------- End List details table ------------------------>
         

<!-- ----------------------- end content area --------------------------------------------------------->
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