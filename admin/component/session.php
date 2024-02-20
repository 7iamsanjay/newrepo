<?php
session_start();
  if(!isset($_SESSION["id"]))
  {
      header("location: login.php");
  }
  if(!isset($_SESSION["userdb"]))
  {
      header("location: login.php");
  }
  if(isset($_POST["logout"]))
  {
    session_destroy();
    header("location: login.php"); 
  }
  
  date_default_timezone_set("Asia/kolkata");
?>