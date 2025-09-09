<?php
require_once("../fun.inc.php");
$db_handle = new DBController();

if (isset($_POST['faculty']) && $_POST['faculty'] !== '') {
  $faculty = mysqli_real_escape_string($db_handle->connectDB(), $_POST['faculty']);
  $query = "SELECT DISTINCT dept FROM course_reg WHERE faculty='$faculty' AND dept != ''";
  $result = $db_handle->runQuery($query);

  echo "<option value=''>Select Department</option>";
  foreach ($result as $row) {
    echo "<option value='{$row['dept']}'>{$row['dept']}</option>";
  }
}
?>
