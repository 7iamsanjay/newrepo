<?php
  include("component/session.php");

  include("database/db_con.php");
   
  
  if(isset($_POST["btnnewlab"]))
  {
    header("location: newlab.php");
  }
  if(isset($_POST["btnnewlist"]))
  {
    header("location: newlist.php");
  }

  

      include("component/countblock.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lab-man</title>
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
          <!------------------content statrts------------------------->

            
           <div class="cutomrow"><center>
            <form method="POST"> 
                    <button name="btnnewlist" class="btn btn-gradient-danger btn-icon-text" style="padding:10px 15px;" id="btnnewlist">
                    <span>New List </span>  <i class="mdi  mdi-folder-plus   btn-icon-prepend"></i> </button>
                    <button name="btnnewlab" class="btn btn-gradient-info btn-icon-text" id="btnnewlist" style="padding:10px 15px;">
                     New Labour <i class="mdi  mdi-folder-plus   btn-icon-prepend"></i> </button>
            </form></center></div>
                            
            <!-- content area-->
             <br> <br>

            <div class="row" >
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> TOTAL LIST <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"> <?php echo$crow1[0];?></h2>
                    <h4 class="card-text"><span style="font-weight: bolder;  padding: 5px; border-radius: 4px;"> <?php echo$crow2[0];?></span> labours</h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">PAID AMOUNT <i class="mdi mdi-currency-inr mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"> <i class="mdi mdi-currency-inr mdi-24px float-right "></i><?php echo$sum;?></h2>
                    <h4 class="card-text"><span style="font-weight: bolder;  padding: 5px; border-radius: 4px;">This Year</span></h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">UN-PAID AMOUNT <i class="mdi mdi-currency-inr mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><i class="mdi mdi-currency-inr mdi-24px float-right"></i> <?php echo$sum1;?></h2>
                    <h4 class="card-text"><span style="font-weight: bolder;  padding: 5px; border-radius: 4px;">This Year</span></h4>
                  </div>
                </div>
              </div>
            </div>
             <!--------------------- Start labours details table ------------------------>
            <div class="row">


            
                <div style="background-color:white; padding:10px;">
                              <table style="width:100%;">
                                <td><h6 class="card-title">
                              <?php
                             //sorting-----------------------------------------------------------------

                            if(isset($_POST["srtbtn"]))
                              {
                                if($_POST['sort'] == 'd'){
                                $condition = " AND ldate like '".date("Y-m-d")."'";
                                echo "Today's Labours.."; 
                               }else if($_POST['sort'] == 'm'){
                                $condition = " AND (ldate >= '".date("Y-m")."-01') " ;
                                echo "".date("M")." Month Labours";
                               }else if($_POST['sort'] == 'y'){
                                $condition = " AND (ldate > '".date("Y")."-01-01' OR ldate like '".date("Y")."-01-01')" ;
                                 echo "This Year Labours.."; 
                               }else if($_POST['sort'] == 'a'){
                                $condition = "" ;
                                 echo "All Time.."; 
                               }else{$condition ="";}
                              }
                              else{$condition = " AND (ldate >= '".date("Y-m")."-01') " ; echo "".date("M")." Month Labours"; }

                              //end-sorting-------------------------------------------------------------
                              ?>

                                </h6></td>
                                <td align="right"><form method="POST" >
                                    
                                    <span style="color:#7d3c98; margin-left:10px;">Sort By This:</span>
                                    <select id="gets" name="sort" style="color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background-color:#0000;" >
                                    <option value="d">DAY</option>
                                    <option value="m" selected>MONTH</option>
                                    <option value="y">YEAR</option>
                                    <option value="a">ALL</option>
                                    </select>
                                    <input type="submit" name="srtbtn" value="SORT" style="color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background: #0000;"/>
                                </form></td></table>
                              
                    <!--<p class="card-description"> Add class <code>.table-bordered</code>-->
                    </p><div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="background-color: #7d3c98; color: white;">
                          <th > # </th>
                          <th> Name </th>
                          <th> <center>Count</center> </th>
                          <th> Paid </th>
                          <th> Pending </th>
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
                           $qry3 = "SELECT name,amt,status,count FROM ".$_SESSION['userdb']." WHERE name='".$row2['name']."'  ".$condition.";";
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
                    </table>
                    </div>
                  </div>
                
              
            </div>
            <br><br>
            <!--------------------- End labours details table ------------------------>
           
           
           <!--------------------- Start List details table ------------------------>
              <div class="row">
              <?php 
                //Query for get listnames
                $res = mysqli_query($conn,"SELECT listname,location,work,ldate,amt FROM ".$_SESSION['userdb']." GROUP BY listname ORDER BY ldate DESC,id DESC;");
                // echo "--------SELECT listname,location,work,ldate FROM ".$_SESSION['userdb']." GROUP BY listname;";
                  $exit = 0;
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
                                  <a href="updatelist.php?list='.$row["listname"].'" class="editlist"><img src="assets/images/ui/editlist.png"></img></a></td></table>
                                <p class="card-description"> Date:<span style="color: #7d3c98; padding:5px 10px;">'.$row["ldate"].'</span>
                                Location:<span style="color: #7d3c98; padding:5px 10px;">'.$row["location"].'</span>
                                Work:<span style="color: #7d3c98; padding:5px 10px;">'.$row["work"].'</span>
                                Amount:<span style="color: #7d3c98; padding:5px 10px;">₹'.$row["amt"].'</span></p>
                            <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th> No </th>
                                  <th> Name </th>
                                  <th> Status </th>
                                  <th> count </th>
                                  <th> Amount </th>
                                  <th> List Date </th>
                                  <th> Paid Date </th>
                                </tr>
                              </thead>
                              <tbody>';
                      //----------------------print records-----------------------
                      $res1 = mysqli_query($conn,"SELECT name,status,amt,pdate,count,ldate FROM ".$_SESSION['userdb']." WHERE listname='".$row["listname"]."';");
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
                                    <td > ₹'.($row1["amt"]*$row1["count"]).' </td>
                                    <td> '.$row1["ldate"].' </td>
                                    <td > '.$row1["pdate"].' </td>
                                    </tr>';
                                  $no++;
                                  $amt+= ($row1["amt"]*$row1["count"]);
                          }
                      //----------------------------------------------------------
                        echo ' </tbody>
                               </table>
                               </div></div><hr>
                               <p class="card-description" style="margin-left:20px;">Paid:<span style="color: #7d3c98; padding:5px 10px;">₹'.$paid.'</span>
                               Pendding:<span style="color: #7d3c98; padding:5px 10px;">₹'.$pendding.'</span>
                               Total:<span style="color: #7d3c98; padding:5px 10px;">₹'.$amt.'</span>';
                         echo '<a href="lists.php?add='.$row["listname"].'" class="addbtn"><img src="assets/images/ui/add1.png"></img>ADD</a>';
                        if($pendding > 0)
                            echo '<a href="paylists.php?list='.$row["listname"].'" class="paybtn"><img src="assets/images/ui/pay.png"></img>PAY</a>';              
                        echo '</p></div></div>';  
                      //exit code                              
                      if($exit > 1)
                          break;
                      else
                          $exit++;
                    }
              ?>
              <div style="width: 100%;">
              <a href="lists.php" style="float: right;"><button style="background-color:#7d3c98 ; border:none; border-radius: 3px; color:white; padding:3px 10px;">VIEW ALL</button></a>
              </div>
            </div>
            <!--------------------- End List details table ------------------------>
               
         
              

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