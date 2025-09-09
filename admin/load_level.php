<?php
require_once("../fun.inc.php");
$db_handle = new DBController();

if (isset($_POST['dept']) && $_POST['dept'] !== '') {
  $dept = mysqli_real_escape_string($db_handle->connectDB(), $_POST['dept']);
  $query = "SELECT DISTINCT level FROM course_reg WHERE dept='$dept' AND level != ''";
  $result = $db_handle->runQuery($query);

  echo "<option value=''>Select Level</option>";
  foreach ($result as $row) {
    echo "<option value='{$row['level']}'>{$row['level']}</option>";
  }
}
?>
