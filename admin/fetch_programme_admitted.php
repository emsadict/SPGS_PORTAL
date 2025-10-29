<?php
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

$dept = $_POST['dept'];

$programmeOptions = "<option value=''>Select Programme</option>";

$progQuery = mysqli_query($conn, "SELECT DISTINCT programme FROM admitted_2022 WHERE dept='$dept'");
while ($row = mysqli_fetch_assoc($progQuery)) {
  $programmeOptions .= "<option value='{$row['programme']}'>{$row['programme']}</option>";
}

echo $programmeOptions;
?>
