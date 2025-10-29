<?php
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

$dept = $_POST['dept'];
$query = "SELECT DISTINCT programme FROM spgs_basicinfo WHERE dept='$dept'";
$result = mysqli_query($conn, $query);

echo "<option value=''>Select Programme</option>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<option value='{$row['programme']}'>{$row['programme']}</option>";
}
?>