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
    <style type="text/css">
      .amsg{display:flex; margin:15px; box-shadow: 4px 4px 11px black; border-radius:4px; }
      .bmsg{ padding:6px;  border-radius: 5px; }
      .bmsg a{text-decoration: none;}
      .cmsg{border-radius: 50% 50%; width: 30px;}
      .dmsg{margin-left: 2%;  padding:10px; width: 80%;}
      .emsg{float:right; }
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
              <cente><div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form method="POST">
                    <h4><i class=" mdi mdi-email " style="color:#047edf ;"></i>Send Message <span style="font-size: 10px; color:grey;">to Admin</span></h4><hr>
                     <input type="text" placeholder=" Write Title" name="tmsg" style="background-image: linear-gradient(to bottom, #f4f4f4, #e4e4e9); border: none;  padding:6px; width:100%; border-radius: 2px; margin-top:15px;" name=""> <br>
                     <textarea name="mmsg" style="border:none; background-image: linear-gradient(to bottom, #f4f4f4, #e4e4e9); padding:6px; border-radius: 2px; width:100%; margin-top:15px;" placeholder="Write Message"></textarea><br>
                     <button style="float:right; margin-top:15px; padding: 10px ;" name="adminmsg" class="btn btn-gradient-info btn-rounded btn-fw">Send</button>
                   </form>
                   <?php
                   if(isset($_POST["adminmsg"]))
                      {
                        include("database/db_con.php");
                        if($_POST['mmsg'] != "" && $_POST['tmsg'] != "")
                        {
                            echo '<span style="font-size:12px;">Message Sended..</span>';
                            mysqli_query($conn,"INSERT INTO msg VALUES(null,'labman','".$_POST['mmsg']."','".$_POST['tmsg']."','".$_SESSION['userdb']."','unseen','".date("Y-m-d")."');");
                        }
                        else
                        {
                            echo '<span style="font-size:12px;">Empty Fields..</span>'; 
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>
              </center>

            </div>

            <div class="row" >
              <div class="">
                <div class="card">
                  
                    <?php 
                        if(isset($_GET['my']))
                        {
                          $msgcon = "sender";
                          $msgcon1 = "";
                        }
                        else
                        {
                          $msgcon = "reciver";
                          $msgcon1 = "or sender='labman'";
                        }
                        include("database/db_con.php");
                        $cmsg = mysqli_query($conn,"select count(reciver) from msg where ".$msgcon."='".$_SESSION['userdb']."' ".$msgcon1.";");
                        $crmsg = mysqli_fetch_row($cmsg);
                    ?>
                    <table width="97%" style="margin:2% 2% 0% 2%;"><tr>
                    <td><h4 ><i class=" mdi mdi-email " style="color: #047edf;"></i> Messages<span style="font-size:14px;">(<?php echo $crmsg[0];?>)</span></h4></td>
                    <td><a style="float:right; text-decoration: none; " href="<?php if(isset($_GET['my'])) echo'msg.php'; else echo'msg.php?my=1';?>"><?php if(isset($_GET['my'])) echo'Recived Messages'; else echo'Sended Messages';?></a></td>
                    </tr></table>
                    <hr>
                   
                         <?php

                            if(!isset($_GET['my']))
                            {
                                    $resmsg = mysqli_query($conn,"select * from msg where reciver='".$_SESSION['userdb']."' or sender='labman'  order by id desc;");
                                    
                                    while($msgrow = mysqli_fetch_assoc($resmsg))
                                    {
                                        echo '<div class="amsg">
                                              <div class="bmsg"><center><img src="assets/images/farmer.png" class="cmsg">
                                              <h6>  '.$msgrow["sender"].'</h6>';
                                        if($msgrow["sender"]!="labman")  echo '<a href="?del='.$msgrow["id"].'">Delete</a>';
                                        echo  '</center></div> 
                                              <span class="dmsg"><span style="color:#7d3c98;"><b>Title:</b> '.$msgrow["title"].'</span> <span style="float:right;">'.$msgrow["date"].'</span><br>'.$msgrow["msg"].'</span></div>';
                                    }
                             }
                             if(isset($_GET['my']))
                             {
                                    $resmsg = mysqli_query($conn,"select * from msg where sender='".$_SESSION['userdb']."'  order by id desc;");
                                    
                                    while($msgrow = mysqli_fetch_assoc($resmsg))
                                    {
                                        echo '<div class="amsg">
                                              <div class="bmsg"><center><img src="assets/images/farmer.png" class="cmsg">
                                              <h6> <span style="font-size:10px;">to</span>'.$msgrow["reciver"].'</h6>';
                                        if($msgrow["sender"]!="labman")  echo '<a href="?del='.$msgrow["id"].'">Delete</a><br>';
                                        if($msgrow["reciver"]=="labman")  echo '<span style="font-size:14px; color:grey;">('.$msgrow['status'].')</span>';
                                        echo  '</center></div> 
                                              <span class="dmsg"><span style="color:#7d3c98;"><b>Title:</b> '.$msgrow["title"].'</span> <span style="float:right;">'.$msgrow["date"].'</span><br>'.$msgrow["msg"].'</span></div>';
                                    }
                             }
                            if(isset($_GET['del']))
                            {
                              mysqli_query($conn,"DELETE from msg where id=".$_GET['del'].";");
                              echo'<script>window.location.replace("msg.php");</script>';
                            }

                          ?>
          



                  
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