<?php
require_once("../fun.inc.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

if (isset($_POST['screen'])) {
  $fields = ['regno','surname','onames','sex','dob','maritalstatus','nationality','state','lg','email',
             'phoneno','address','passport','faculty','dept','programme','title','refDate','level','semester','session'];

  $values = [];
  foreach ($fields as $field) {
    $values[$field] = mysqli_real_escape_string($conn, $_POST[$field]);
  }

  $sql = "INSERT INTO screened_candidates_2022 (" . implode(',', array_keys($values)) . ")
          VALUES ('" . implode("','", array_values($values)) . "')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Candidate screened successfully'); window.location.href='forms-layouts.php';</script>";
  } else {
    echo "<script>alert('Screening failed'); window.history.back();</script>";
  }
}
?>
