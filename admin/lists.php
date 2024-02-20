<?php
include("component/session.php");

  if(isset($_POST['addtolist']))
    {
      $amt =$_POST['Amount'];
      $work = $_POST['work'];
      $ldate = date("Y-m-d",strtotime($_POST['ldate']));
      $location = $_POST['location'];
      if($_GET['add'] != null And $amt != null And $work != null And $ldate != null And $location != null)
      {
            if(isset($_POST['arrlab'])) 
            { 
                $lb = $_POST['arrlab'];
                $co = $_POST['co'];
                $no = 0;
                include("database/db_con.php");
                    $lqry = mysqli_query($conn,"SELECT max(listid) FROM ".$_SESSION['userdb'].";");
                    $ldata = mysqli_fetch_row($lqry);
                    $list_id = mysqli_fetch_row(mysqli_query($conn,"SELECT distinct
                      (listid) from ".$_SESSION['userdb']." WHERE listname='".$_GET['add']."';"));
                    $listid= $ldata[0];
                    $msg = $listid;
                foreach($lb as $LB)
                 {
                    $lqry = mysqli_query($conn,"SELECT name FROM labours WHERE lid=".$LB.";");
                    $ldata = mysqli_fetch_row($lqry);                    

                    $qry = "INSERT INTO `".$_SESSION['userdb']."` VALUES (NULL,".$list_id[0].",".$LB.",'".$_GET['add']."','".$ldata[0]."','".$location."','".$work."',".$co[$no].",".$amt.",'PENDDING',NULL,'".$ldate."');";
                    $msg = $qry;
                    mysqli_query($conn,$qry);
                    $no++;
                 }
                 header("location: ?view=".$_GET[add]);
            }else{$msg = "please Select labours";}
      }
      else
      {
        $msg = "please Fill All Fields...";
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

<br>
          <form method="POST" >
                <span style="color:#7d3c98; margin-left:10px;">Select List:</span>
                <select  id="gets" name="vlist" style="color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background-color:#0000;" onchange="redlist()">
                
                <?php 
                  $listqry = mysqli_query($conn,"Select listname from ".$_SESSION['userdb']." GROUP by listname order by lid desc;");
                  while($listrow = mysqli_fetch_assoc($listqry))
                  { echo '<option> '.$listrow["listname"].' </option>';}
                ?>
                </select>
                <input type="submit" name="vbtn" value="VIEW" style="color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background: #0000;"/>
                <a href="lists.php" style="text-decoration: none; color:#7d3c98; border-radius: 5px; border:1px solid #7d3c98; background: #0000; padding: 1.5px;">RESET</a>
          </form>
<br>     
          <div class="row" style="display:<?php if(!isset($_GET["add"])) echo "none";?>;">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div clas="card-body" style="padding:20px;">
                      <h4 class="card-title"><span style="color:white; padding:5px 13px; border-radius:5px; background-color:#7d3c98;"><?php echo $_GET["add"];?></span></h4>
                    <form class="form-sample" method="POST">
                      <p class="card-description"> <?php if(isset($msg)) echo '<span style="color:red;">'.$msg."</span>"; else echo "";?></p>
                              <?php
                                include('database/db_con.php');
                                if($getcheck = mysqli_fetch_row(mysqli_query($conn,"SELECT listname,location,work,amt from ".$_SESSION['userdb']." WHERE listname='".$_GET['add']."';")))
                                  {

                                  }                                


                              ?>



                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">type Of Work</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="work" value="<?php echo $getcheck[2];?>"/>
                            </div>
                          </div>
                        </div>
                         <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" name="Amount" value="<?php echo $getcheck[3];?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                              <input type="date" id="currentDate" class="form-control" name="ldate" placeholder="yyyy-mm-dd" />
                                            <script type="text/javascript">
                                            var date = new Date();
                                            var currentDate = date.toISOString().substring(0,10);
                                            document.getElementById('currentDate').value = currentDate;
                                            </script>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="location" value="<?php echo $getcheck[1];?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                  <div class="row" style="padding:20px;">


                    <?php
                    if(isset($_GET['add']))
                    {
                        
                        if($check = mysqli_fetch_row(mysqli_query($conn,"SELECT listname from ".$_SESSION['userdb']." WHERE listname='".$_GET['add']."';")))
                          {
                                      
                                      $qry="SELECT * FROM labours WHERE uid=".$_SESSION['id']." AND userdb='".$_SESSION['userdb']."';";
                                      $res = mysqli_query($conn,$qry);

                                      
                                        while($row = mysqli_fetch_assoc($res)){
                                                  $lid = $row['lid'];
                                                  $lname = $row['name'];
                                                  if(strlen($lname)>24)
                                                  {
                                                    $lname = substr($lname,0,24)."..";
                                                  }
                                                  $gender = $row['gender'];
                                                  $add = $row['location'];
                                                    echo '
                                                          <div class="col-md-6">
                                                          <div style="width:100%;"><table class="tab1">
                                                          <tr><td width="70%"><input type="checkbox" class="lchk" name="arrlab[]" onclick="nameatr(id='.$lid.')" value="'.$lid.'" id="'.$lid.'">
                                                          <i class="mdi  mdi mdi-account btn-icon-prepend"></i> <span style="color:#7d3c98; font-weight:bolder; margin-right:10px; ">'.$lname.'  </span></td>
                                                          <td width="15%"><span style="color:#d5d8dc;">'.$gender.'</span></td><td width="15%"><span style="color:#d5d8dc;">'.$add.'</span></td>';
                                                    echo '<td>
                                                          <select id="'.($lid * 2).'" style="background:white; border:1px solid black;" name="">
                                                          <option value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          </select></td>';
                                                    echo '</tr></table>
                                                          </div></div>';
                                          }
                                echo '
                                        <div class="form-group row">
                                        <div style="display: flex; margin-top: 10px; padding-top: 30px;">
                                        <button type="submit" class="btn btn-gradient-primary me-2" name="addtolist">ADD</button>
                                        <a href="lists.php" class="btn btn-light">Cancel</a>';
                          }
                          else
                            echo "Listname is wrong";
                    }
                    ?>


                      </form>
                  </div>
                </div>
            </div>
          </div>

          <div class="row" style="display:<?php if(isset($_GET["add"])) echo "none";?>;">
              <?php 
                        if(isset($_GET['view']))
                          $condition =" WHERE listname='".$_GET['view']."' ";
                        else
                          $condition ="";
                        if(isset($_POST['vbtn']))
                          $condition =" WHERE listname='".$_POST['vlist']."' ";
                //Query for get listnames
                $res = mysqli_query($conn,"SELECT listname,location,work,ldate,amt FROM ".$_SESSION['userdb']." ".$condition." GROUP BY listname ORDER BY ldate DESC,id DESC;");
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
                        echo '<a href="viewlist.php?list='.$row["listname"].'" class="addbtn"><i class=" mdi mdi-arrange-bring-to-front"></i>view Summery</a>
                              </p></div></div>';  
                     
                    }
              ?>

              
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
   <script type="text/javascript">
      function nameatr(lid){
      var chk = document.getElementById(lid);
      var ico = lid*2;
      if(chk.checked == true)
      {
        
        var atr = document.getElementById(ico).setAttribute("name","co[]");
      }
      else
      {
        var atr = document.getElementById(ico).setAttribute("name","");
      }
      }
   </script>
  </body>
</html>