<?php
include("component/session.php");

  if(isset($_GET['lname']))
  {
    include("database/db_con.php");
    $labpay = mysqli_query($conn,'select id from '.$_SESSION["userdb"].' where status!="PAID" and name="'.$_GET["lname"].'" and listname="'.$_GET["list"].'";');
    while($LB = mysqli_fetch_assoc($labpay))
    {
    $qryget = mysqli_query($conn,'select amt,lid,name,listid,listname,id,count from '.$_SESSION["userdb"].' where id = '.$LB["id"].';');
    $resget = mysqli_fetch_row($qryget);
    $tamt = $resget[0]*$resget[6];
    mysqli_query($conn,"insert into transaction values(null,'".$_SESSION['userdb']."',".$resget[1].",".$resget[3].",'".$resget[4]."','".$resget[2]."',".$tamt.",".$resget[5].",'".date('Y-m-d')."');");
    }
    mysqli_query($conn,'UPDATE '.$_SESSION['userdb'].' SET status="PAID",pdate="'.date('Y-m-d').'" WHERE status!="PAID" and name="'.$_GET["lname"].'" and listname="'.$_GET["list"].'";');
    echo '<script>alert("Succesfull"); window.location.replace("labpay.php?list='.$_GET["list"].'");</script>';
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
        


              <div style="background-color:white; padding:10px;">
                             <h4>Pay Labours</h4>
                              
                    <!--<p class="card-description"> Add class <code>.table-bordered</code>-->
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="background-color: #7d3c98; color: white;">
                          <th > # </th>
                          <th> Name </th>
                          <th> Pendding </th>
                          <th> Pay </th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                       if(!isset($_GET['list']))
                          echo '<script> alert("list not set"); window.location.replace("admin.php");</script>';
                        $no=0;
                        $tcount = 0;
                        $tpaid = 0;
                        $tpen = 0;
                        $paylink = 'href="?list='.$_GET["list"].'&lname=';
                        $qry2 = "SELECT name FROM labours WHERE userdb='".$_SESSION['userdb']."';";
                        $res2 = mysqli_query($conn,$qry2);

                        while($row2 = mysqli_fetch_assoc($res2))
                        {
                           $paidamt=0;
                           $Penddingamt=0;
                           $c=0; //count for multiply
                           $qry3 = "SELECT name,amt,status,count FROM ".$_SESSION['userdb']." WHERE name='".$row2['name']."' and listname='".$_GET['list']."';";
                          // echo $qry3;
                           $res3 = mysqli_query($conn,$qry3);
                           while($row3 = mysqli_fetch_assoc($res3))
                            {
                                if($row3['status'] == 'PENDDING')
                                    $Penddingamt+=((float)$row3['amt']*$row3['count']);
                                else
                                    $paidamt+=((float)$row3['amt']*$row3['count']);
                                $c+=$row3['count'];
                            } 
                            if($Penddingamt >0)
                            {
                                 if($c!=0){
                                      $no++;
                                      echo "<tr>
                                      <td> ".$no." </td>
                                      <td> ".$row2['name']." </td>"; 
                                      echo "<td> ₹ ";
                                      echo '<span style="color:red;">';
                                      echo "".$Penddingamt."</span> </td>";                                
                                      echo '<td> <a '.$paylink.$row2['name'].' ">pay</a> </td>';
                                      echo "</tr>";
                                  }
                            }
                            $tcount+= $c;
                            $tpaid+=$paidamt;
                            $tpen+= $Penddingamt;
                        }
                           echo '<tr style="border:none;"><td colspan="2" style="border:none;"></td>
                           <td style="border:none;"><b>₹'.($tpen).'</b></td></tr>'; 

                      ?>
                      </tbody>
                    </table>
                   </div></div>
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