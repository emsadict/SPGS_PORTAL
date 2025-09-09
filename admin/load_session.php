<?php
require_once("../fun.inc.php");
$db_handle = new DBController();

if (isset($_POST['level']) && $_POST['level'] !== '') {
  $level = mysqli_real_escape_string($db_handle->connectDB(), $_POST['level']);
  $query = "SELECT DISTINCT session FROM course_reg WHERE level='$level' AND session != ''";
  $result = $db_handle->runQuery($query);

  echo "<option value=''>Select Session</option>";
  foreach ($result as $row) {
    echo "<option value='{$row['session']}'>{$row['session']}</option>";
  }
}
?>
