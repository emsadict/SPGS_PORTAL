<?php
    session_start();
    include_once("../fun.inc.php");
    

    $spgs_auth=$_SESSION['spgs_auth'];

    $user=$spgs_auth[1];
   // echo $user;
    $adminrec=getRecs("admin_table","username",$user);
   $role = $adminrec['role'];
    if($role == 'SUPERADMIN')
    {

    header("location: admindashboad.php");

    }
    elseif($role == 'ADMIN')
    {

    header("location: admin.php");

    }
?>