<?php
include("component/session.php");


if(isset($_GET['msg']))
      $msg = $_GET['msg'];
  //------------------------------- adding Labours ------------------------------------
     

    

   if(isset($_POST['createlist']))
    {     


     include("database/db_con.php");
     $chklist = mysqli_query($conn,"SELECT listname FROM ".$_SESSION['userdb']." WHERE listname = '".$_POST['listname']."';");
     
     $checkname = mysqli_fetch_row($chklist); //check lisname is alredy exist\
     
     if($checkname[0] != strtolower($_POST['listname']))
     {
                              $listname = str_replace(' ', '-', $_POST['listname']);

                              $amt =$_POST['Amount'];
                              $work = $_POST['work'];
                              $ldate = date("Y-m-d",strtotime($_POST['ldate']));
                              $location = $_POST['location'];
                              if($listname != null And $amt != null And $work != null And $ldate != null And $location != null)
                              {
                                    if(isset($_POST['arrlab'])) 
                                    { 
                                        $lb = $_POST['arrlab'];
                                        $co = $_POST['co'];
                                        $no = 0;
                                       
                                            $lqry = mysqli_query($conn,"SELECT max(listid) FROM ".$_SESSION['userdb'].";");
                                            $ldata = mysqli_fetch_row($lqry);
                                            $listid= $ldata[0]+1;
                                            $msg = $listid;
                                        foreach($lb as $LB) //get all labours from select tag
                                         {
                                            $lqry = mysqli_query($conn,"SELECT name FROM labours WHERE lid=".$LB.";");
                                            $ldata = mysqli_fetch_row($lqry);


                                            $qry = "INSERT INTO `".$_SESSION['userdb']."` VALUES (NULL,".$listid.",".$LB.",'".$listname."','".$ldata[0]."','".$location."','".$work."',".$co[$no].",".$amt.",'PENDDING',NULL,'".$ldate."');";
                                            mysqli_query($conn,$qry);
                                            $no++;
                                         }
                                         header("location: newlist.php?msg=List Created");

                                    }else{$msg = "please Select labours";}
                              }
                              else
                              {
                                $msg = "please Fill All Fields...";
                              }

     }else
     {$msg = " Listname is alredy exist";}  
    }
    
  //---------------------------------------------------------------------------------












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
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create New List</h4>
                    <form class="form-sample" method="POST">
                      <p class="card-description"> <?php if(isset($msg)) echo '<span style="color:red;">'.$msg."</span>"; else echo "provide required infromation";?></p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">List Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="listname" value="<?php if(isset($_POST['listname'])) echo $_POST['listname'];?>" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">type Of Work</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="work" value="<?php if(isset($_POST['work'])) echo $_POST['work'];?>" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Amount</label>
                            <div class="col-sm-9">
                              <input type="number" class="form-control" name="Amount" value="<?php if(isset($_POST['Amount'])) echo $_POST['Amount'];?>" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                              <input type="date" id="currentDate" class="form-control" name="ldate" placeholder="yyyy-mm-dd" required/>
                                            <script type="text/javascript">
                                            var date = new Date();
                                            var currentDate = date.toISOString().substring(0,10);
                                            document.getElementById('currentDate').value = currentDate;
                                            </script>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="location" value="<?php if(isset($_POST['location'])) echo $_POST['location'];?>" required/>
                            </div>
                          </div>
                        </div>
                        <!-- date("Y-m-d",strtotime("25-02-2002")); -->
                     <h4>Select labours</h4>
                     <div class="row">
                            
                     <?php

                     //-----------------------------------show listed labours---------------------------------------------
                          
                          include("database/db_con.php");
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
                          

                     ?>
                     </div>

                      
                            <div style="display: flex; margin-top: 10px; padding-top: 30px;">
                            <button type="submit" class="btn btn-gradient-primary me-2" name="createlist">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                          
                        
                        
                      
                     
                    
                  </div>
                </div>
              </div>
            
             

             </form> </div>
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
   <!------------------dynamic attribute-------------------->
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