<?php
include("component/session.php");

    if(isset($_GET['list']))
    {
        include("database/db_con.php");
        //$check = mysqli_fetch_row(mysqli_query($conn,"SELECT distinct(listid) FROM ".$_SESSION['userdb']." where listname= '".$_GET['list']."';"));
        //echo "SELECT distinct(listid) FROM ".$_SESSION['listname']." where listname= '".$_GET['list']."';";
        if($check = mysqli_fetch_row(mysqli_query($conn,"SELECT distinct(listid) FROM ".$_SESSION['userdb']." where listname= '".$_GET['list']."';")))
          {
              $verify = 1;
          }
    }
    else
      header("location: lists.php");


    if(isset($_POST['update']))
    {   

        if($_POST['listname'] != null AND $_POST['work'] != null AND $_POST['amount'] != null AND $_POST['ldate'] != null AND $_POST['location'] != null)
        {

          include("database/db_con.php");
           $listname = str_replace(' ', '-', $_POST['listname']);
          if (mysqli_query($conn,"UPDATE ".$_SESSION['userdb']." SET listname='".$listname."' , location = '".$_POST['location']."' , amt =".$_POST['amount']." , ldate = '".$_POST['ldate']."' ,work = '".$_POST['work']."' WHERE listname='".$_GET['list']."';")) {
             $msg = '<script> alert("Updated"); window.location.href = "lists.php?view='.$_GET['list'].'";</script>';
          }
        }
        else
          $msg = "empty true";
        
    }




    if(isset($_POST['updatelab']))
    {

        if(isset($_GET['row']) and isset($_GET['list']))
         {          
                      $count = $_POST['count'];
                      if($count > 0 AND $count < 5)
                      {
                                    include("database/db_con.php");
                                    if (isset($_POST['status']))
                                    {
                                      // 5 fields update
                                        if($_POST['ldate'] != "" AND $_POST['pdate'] != "" AND $_POST['status'] != "")
                                        {
                                             //ready to go   
                                              
                                            if(mysqli_query($conn,"UPDATE ".$_SESSION['userdb']." SET ldate='".$_POST['ldate']."', count=".$count.",pdate='".$_POST['pdate']."',status='".$_POST['status']."' WHERE id=".$_GET['row'].";"))
                                            {
                                                if($_POST['status']!="PAID")
                                                {
                                                  mysqli_query($conn,"UPDATE ".$_SESSION['userdb']." SET pdate=null WHERE id=".$_GET['row'].";");
                                                  $delqry = mysqli_query($conn,"DELETE from transaction where rid=".$_GET['row'].";");

                                                }
                                                header("location: updatelist.php?list=".$_GET['list']); 
                                            }else
                                                echo '<script> alert("oppssss..");</script>';
                                        }
                                        else
                                        {
                                            echo '<script> alert("empty fields...");</script>';          
                                        }
                                    }
                                  else
                                    {
                                      // 3 fields update
                                        if($_POST['ldate'] != "")
                                        {
                                            //ready to go
                                            if(mysqli_query($conn,"UPDATE ".$_SESSION['userdb']." SET ldate='".$_POST['ldate']."', count=".$count." WHERE id=".$_GET['row'].";"))
                                            {
                                                header("location: updatelist.php?list=".$_GET['list']);     
                                            }
                                            else
                                              echo '<script> alert("oppssss..");</script>';
                                        }
                                        else
                                        {
                                            echo '<script> alert("empty fields...");</script>';          
                                        }
                                    }                  
                      }
                      else
                      {
                          echo '<script> alert("count is must between 1 to 4.. ('.$count.')");</script>';  
                      }
         } 
         else
         {
            echo '<script> alert("error");</script>';
         }

    }

    if(isset($_GET['del']))
    {
      include 'database/db_con.php';
      if(mysqli_query($conn,"DELETE FROM ".$_SESSION['userdb']." WHERE id=".$_GET['del']." AND listname='".$_GET['list']."';"))
      {
        header("location: updatelist.php?list=".$_GET['list']);  
      }
    }
     if(isset($_GET['listdel']) AND $_GET['listdel'] == "true")
    {
      include 'database/db_con.php';
      if(mysqli_query($conn,"DELETE FROM ".$_SESSION['userdb']." WHERE listname='".$_GET['list']."';"))
      {
        header("location: lists.php");  
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
     <style>
      addbtn{text-decoration: none; padding:15px 10px; margin-top: -58px; margin-right: -32px; border-radius: 10px; background-color: #7d3c98; border-left: 1px solid  #7d3c98; float: right; border-bottom: 1px solid  #7d3c98;color: white;}
      .addbtn{float:right; text-decoration:none; color: #7d3c98; padding:2px 25px; margin-right: 10px ; margin-top: 10px;  background-color:#0000; border:1px solid #7d3c98; border-radius:3px;}
      .paybtn{float:right; margin-top: 10px; text-decoration:none; color: #7d3c98; padding:2px 25px;  margin-right:22px; background-color:#0000; border:1px solid #7d3c98; border-radius:3px;}
      .paybtn img{width: 17px; margin-right: 2px;}
      .addbtn img{width: 17px; margin-right: 2px;}
      .imgedit{width: 20px; float: right; margin-right: -25px; margin-top: -47px;}
      .btn-del{float:right; background-color:#0000; border:1px solid #7d3c98; color:#7d3c98; border-radius: 3px; transition: 0.3s;}
      .btn-del:hover{background-color: #7d3c98; color: white;}
      .btn-modi{border: none; background-color:#0000; padding:2px; border-radius:3px; color:blue; text-decoration: none;}
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
          if (isset($verify)) 
            {

               include("database/db_con.php");
                                                                //   0        1       2    3   4
               $data = mysqli_fetch_row(mysqli_query($conn,"SELECT listname,location,work,amt,ldate from ".$_SESSION['userdb']." WHERE listname='".$_GET['list']."' AND id = (SELECT min(id) from ".$_SESSION['userdb']." where listname='".$_GET['list']."');"));
                if(isset($_GET['row']))
                  $showdiv ='style="display:none;"';
                else
                  $showdiv = 'class="row"';
              echo '<div '.$showdiv.'>
                <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <span class="card-title">Update List</span><button class="btn-del" onclick="listdel()"> DELETE LIST </button>
                    <form class="form-sample" method="POST">
                      <p class="card-description" style="color:red;"> ';
                      if (isset($msg)) echo $msg;
                echo ' </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">List Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="listname" value="'.$data[0].'" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">type Of Work</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="work" value="'.$data[2].'" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" name="amount" value="'.$data[3].'" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                              <input type="date" id="currentDate" class="form-control" name="ldate" value="'.$data[4].'" placeholder="yyyy-mm-dd" required/>
                                          
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="location" value="'.$data[1].'" required/>
                            </div>
                          </div>
                        </div>
                    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <div style="display: flex; margin-top: 10px; padding-top: 30px;">
                        <button type="submit" class="btn btn-gradient-primary me-2" name="update">Update</button>
                                        <a href="lists.php" class="btn btn-light">Cancel</a></div>
                      </div></div></div></div>
                    </form>';        
            }
            else
            {
                      echo "list not exist..";
            }
        ?>
          

            
      </div></div></div></div>

      <!-------------------------------labour edit-------------------------------------------------->

      <div class="row" style="display:<?php if(!isset($_GET["list"])) echo "none";?>;">
              <?php 
                        if(isset($_GET['list']))
                          $condition =" WHERE listname='".$_GET['list']."' ";
                        else
                          $condition ="";
                //Query for get listnames
                $res = mysqli_query($conn,"SELECT listname,location,work,ldate,amt FROM ".$_SESSION['userdb']." ".$condition." GROUP BY listname ORDER BY ldate DESC,id DESC;");
                // echo "--------SELECT listname,location,work,ldate FROM ".$_SESSION['userdb']." GROUP BY listname;";
                  $no = 1;
                while($row = mysqli_fetch_assoc($res)) 
                    {                  
                        echo '<div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                              <div clas="card-body" style="padding:20px;">
                              
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
                                  <th> Action </th>
                                </tr>
                              </thead>
                              <tbody>';
                      //----------------------print records-----------------------
                      $res1 = mysqli_query($conn,"SELECT name,status,amt,pdate,count,ldate,id FROM ".$_SESSION['userdb']." WHERE listname='".$row["listname"]."';");
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
                                    
                                  }
                              else
                                  {
                                   $statuscolor = "success";
                                   
                                  }

                              if(isset($_GET['row']) AND $_GET['row'] == $row1['id'])
                              {
                                  echo '<tr><form method="POST">
                                    <td >'.$no.'</td>
                                    <td >'.$lname.'  </td>';
                                  if($row1['status'] == "PENDDING")
                                    {echo '<td><label class="badge badge-gradient-'.$statuscolor.'">'.$row1["status"].'</label></td>';}
                                  else 
                                    {echo '<td><SELECT name="status">
                                      <option value="PAID">PAID</option>
                                      <option value="PENDDING">PENDDING</option>
                                    </select></td>';}
                                  echo'<td> <input type="number" max="4" min="1" style="width:50px;" name="count" value="'.$row1["count"].'"></td>
                                    <td > $'.($row1["amt"]*$row1["count"]).' </td>
                                    <td> <input type="date" name="ldate" value="'.$row1["ldate"].'"> </td><td>';
                                  if($row1['status'] != "PENDDING")
                                  echo'<input type="date" name="pdate" value="'.$row1["pdate"].'">';

                                  echo '</td><td> <button type="submit" style="border:1px solid blue; background-color:#0000; padding:5px; border-radius:3px; color:blue;" name="updatelab">UPDATE</button><a href="?list='.$_GET['list'].'" style="border:1px solid blue; text-decoration:none; margin-left:2px; background-color:#0000; padding:5px; border-radius:3px; color:blue;" >CANCEL</a></td>
                                    </form></tr>';
                                  $no++;
                              }else
                              {
                              echo '<tr>
                                    <td >'.$no.'</td>
                                    <td >'.$lname.'</td>
                                    <td><label class="badge badge-gradient-'.$statuscolor.'">'.$row1["status"].'</label></td>
                                    <td>'.$row1["count"].'</td>
                                    <td > ₹'.($row1["amt"]*$row1["count"]).' </td>
                                    <td> '.$row1["ldate"].' </td>
                                    <td > '.$row1["pdate"].' </td>
                                    <td> 
                                    <a href="updatelist.php?list='.$_GET["list"].'&row='.$row1["id"].'" class="btn-modi">EDIT</a>|
                                    <button onclick="delfun('.$row1["id"].')" class="btn-modi">DELETE</button></
                                    </td>
                                    </tr>';
                                  $no++;
                              }
                                  
                          }
                      //----------------------------------------------------------
                        echo ' </tbody>
                               </table>
                               </div></div>';
                        echo '</div></div>';  
                     
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
    <script type="text/javascript">
      function delfun(data)
      {
        if(confirm("DO YOU WANT TO DELETE.."))
        {
          window.location.replace("?<?php echo "list=".$_GET['list']."&";?>del="+data);        
        }
      }
       function listdel(data)
      {
        if(confirm("DO YOU WANT TO DELETE <?php echo "(".$_GET['list'].")";?> LIST.."))
        {
          window.location.replace("?<?php echo "list=".$_GET['list']."&";?>listdel=true");        
        }
      }
    </script>
   <?php include("component/js.html"); ?> 
  </body>
</html>