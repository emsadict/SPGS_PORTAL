<?php
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

$faculty = $_POST['faculty'];

$deptRes = mysqli_query($conn, "SELECT DISTINCT dept FROM Screened_Candidates_2022 WHERE faculty='$faculty'");
$sessionRes = mysqli_query($conn, "SELECT DISTINCT session FROM Screened_Candidates_2022 WHERE faculty='$faculty'");

echo "<option value=''>Select Department</option>";
while ($row = mysqli_fetch_assoc($deptRes)) {
  echo "<option value='{$row['dept']}'>{$row['dept']}</option>";
}

echo "|"; // delimiter

echo "<option value=''>Select Session</option>";
while ($row = mysqli_fetch_assoc($sessionRes)) {
  echo "<option value='{$row['session']}'>{$row['session']}</option>";
}
?>
