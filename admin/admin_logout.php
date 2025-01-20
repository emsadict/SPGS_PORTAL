<?php
session_start();
//if(isset($_REQUEST['from']) && $_REQUEST['from']=="updp"){
	session_unset();
	header("location:index.php");
//}
?>