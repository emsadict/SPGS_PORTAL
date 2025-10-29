<?php
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

$faculty = $_POST['faculty'];

$deptOptions = "<option value=''>Select Department</option>";

$deptQuery = mysqli_query($conn, "SELECT DISTINCT dept FROM spgs_basicinfo WHERE faculty='$faculty'");
while ($row = mysqli_fetch_assoc($deptQuery)) {
  $deptOptions .= "<option value='{$row['dept']}'>{$row['dept']}</option>";
}

echo $deptOptions;
?>
