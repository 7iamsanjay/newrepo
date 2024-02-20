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
        


  <div class="row" >
              <?php 



                        if(isset($_GET['list']))
                          $condition =" WHERE listname='".$_GET['list']."' ";
                        else
                          echo '<script> alert("list not set"); window.location.replace("admin.php");</script>';
                //Query for get listnames
                $res = mysqli_query($conn,"SELECT listname,location,work,ldate,amt FROM ".$_SESSION['userdb']." ".$condition." GROUP BY listname ;");
                // echo "--------SELECT listname,location,work,ldate FROM ".$_SESSION['userdb']." GROUP BY listname;";
                  
                while($row = mysqli_fetch_assoc($res)) 
                    {
                      $no = 1;
                      $amt = 0;
                      $paid = 0;
                      $pendding = 0;
                        
                        echo '<div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                              <div clas="card-body" style="padding:20px;">
                                <table style="width:100%;";><td>
                                <h4 class="card-title"><span style="color:white; padding:5px 13px; border-radius:5px; background-color:#7d3c98;">'.$row["listname"].'</span></h4></td><td>
                                 </td></table><hr>
                            <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th> No </th>
                                  <th> Name </th>
                                  <th> Status </th>
                                  <th> count </th>
                                  <th> charge </th>
                                  <th> Total Amount </th>
                                  <th> List Date </th>
                                  <th> Paid Date </th>
                                  <th> work </th>
                                  <th> Location </th>
                                </tr>
                              </thead>
                              <tbody>';
                      //----------------------print records-----------------------
                      $res1 = mysqli_query($conn,"SELECT * FROM ".$_SESSION['userdb']." WHERE listname='".$row["listname"]."';");
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
                                    $pendding += ($row1["amt"]*$row1['count']);
                                  }
                              else
                                  {
                                   $statuscolor = "success";
                                   $paid += ($row1["amt"]*$row1['count']);
                                  }


                              echo '<tr>
                                    <td >'.$no.'</td>
                                    <td >'.$lname.'</td>
                                    <td><label class="badge badge-gradient-'.$statuscolor.'">'.$row1["status"].'</label></td>
                                    <td>'.$row1["count"].'</td>
                                    <td> ₹'.$row1["amt"].' </td>
                                    <td ><b> ₹'.($row1["amt"]*$row1["count"]).' </b></td>
                                    <td> <b>'.$row1["ldate"].' </b></td>
                                    <td > '.$row1["pdate"].' </td>
                                    <td > '.$row1["work"].' </td>
                                    <td > '.$row1["location"].' </td>
                                    </tr>';
                                  $no++;
                                  $amt+= ($row1["amt"]*$row1["count"]);
                          }
                      //----------------------------------------------------------

                        echo ' </tbody>
                               </table>
                               
                              </div></div>';  
                     
                    }
              ?>
              <div style="background-color:white; padding:10px;">
                             <h4>Summary of list</h4>
                              
                    <!--<p class="card-description"> Add class <code>.table-bordered</code>-->
                    </p><div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="background-color: #7d3c98; color: white;">
                          <th > # </th>
                          <th> Name </th>
                          <th> <center>Count</center> </th>
                          <th> Paid </th>
                          <th> Pendding </th>
                          <th> Total </th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                       
                        $no=0;
                        $tcount = 0;
                        $tpaid = 0;
                        $tpen = 0;
                        $qry2 = "SELECT name FROM labours WHERE userdb='".$_SESSION['userdb']."';";
                        $res2 = mysqli_query($conn,$qry2);

                        while($row2 = mysqli_fetch_assoc($res2))
                        {
                           $paidamt=0;
                           $Penddingamt=0;
                           $c=0;
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
                           if($c!=0){
                                $no++;
                                echo "<tr>
                                <td> ".$no." </td>
                                <td> ".$row2['name']." </td>
                                <td><center><span>".$c."</span></center></td>
                                <td> ₹ "; echo '<span style="color:green;">';
                                echo " ".$paidamt." </span></td>
                                <td> ₹ ";echo '<span style="color:red;">';
                                echo "".$Penddingamt."</span> </td>
                                <td> ₹ ".($paidamt+$Penddingamt)." </td>
                                </tr>";
                            }
                            $tcount+= $c;
                            $tpaid+=$paidamt;
                            $tpen+= $Penddingamt;
                        }
                           echo '<tr style="border:none;"><td colspan="2" style="border:none;"></td>
                           <td style="border:none;"><center>'.$tcount.'</center></td>
                           <td style="border:none;">₹<span style="color:green;">'.$tpaid.'</span></td>
                           <td style="border:none;">₹<span style="color:red;">'.$tpen.'</span></td>
                           <td style="border:none;">₹'.($tpaid+$tpen).'</td></tr>'; 

                      ?>
                      </tbody>
                    </table><center>
                   <?php
                    echo '<a href="lists.php?add='.$_GET["list"].'" class="addbtn"><img src="assets/images/ui/add1.png"></img>ADD</a>';
                    if($pendding > 0)
                            echo '<a href="paylists.php?list='.$_GET["list"].'" class="addbtn"><img src="assets/images/ui/pay.png"></img>PAY</a>';              
                    echo '<a href="updatelist.php?list='.$_GET["list"].'" class="addbtn"><img src="assets/images/ui/editlist.png"></img>Edit</a>';
                    ?></center></div>
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