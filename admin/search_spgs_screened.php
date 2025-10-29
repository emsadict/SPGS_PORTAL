<?php
include_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

$regno = $_POST['regno'];
$faculty = $_POST['faculty'];
$dept = $_POST['dept'];
$session = $_POST['session'];
$programme = $_POST['programme'];

$query = "SELECT * FROM spgs_basicinfo WHERE 1";
if (!empty($regno)) $query .= " AND regno='$regno'";
if (!empty($faculty)) $query .= " AND faculty='$faculty'";
if (!empty($dept)) $query .= " AND dept='$dept'";
if (!empty($session)) $query .= " AND session='$session'";
if (!empty($programme)) $query .= " AND programme='$programme'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
      <td>{$row['regno']}</td>
      <td>{$row['surname']}</td>
      <td>{$row['onames']}</td>
      <td>{$row['dept']}</td>
      <td>{$row['programme']}</td>
      <td>{$row['session']}</td>
    </tr>";
  }
} else {
  echo "<tr><td colspan='6'>No records found.</td></tr>";
}
?>
