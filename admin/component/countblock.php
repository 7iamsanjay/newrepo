<?php 
            include("database/db_con.php");
            $crow1 = mysqli_fetch_row(mysqli_query($conn,"SELECT count(DISTINCT(listname)) FROM ".$_SESSION['userdb'].";"));
            $crow2 = mysqli_fetch_row(mysqli_query($conn,"SELECT count(DISTINCT(lid)) FROM labours WHERE userdb='".$_SESSION['userdb']."';"));
            $crow3 = mysqli_query($conn,"SELECT count,amt FROM ".$_SESSION['userdb']." WHERE status='PAID' AND (ldate > '".date("Y")."-01-01' OR ldate like '".date("Y")."-01-01');");

            $sum = 0;
            while($palist = mysqli_fetch_assoc($crow3))
              $sum+=($palist['count']*$palist['amt']);

            $crow4 = mysqli_query($conn,"SELECT count,amt FROM ".$_SESSION['userdb']." WHERE status!='PAID' AND (ldate > '".date("Y")."-01-01' OR ldate like '".date("Y")."-01-01');");
            $sum1 = 0;
            while($palist = mysqli_fetch_assoc($crow4))
              $sum1+=($palist['count']*$palist['amt']);
        ?>