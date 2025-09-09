<?php
require_once("../fun.inc.php");
$db_handle = new DBController();

if (isset($_POST['regno'])) {
  $regno = $_POST['regno'];
  $result = resultnew("SELECT * FROM admitted_2022 WHERE regno='$regno'");
  $row = mysqli_fetch_array($result);

  // Fields to display as readonly
 $fields = [
  'regno','surname','onames','sex','dob','maritalstatus','nationality','state','lg','email',
  'phoneno','address','passport','faculty','dept','programme','title','session'
];


  echo "<div class='row'>";
  foreach ($fields as $field) {
    $value = htmlspecialchars($row[$field]);
    echo "<div class='col-md-6 mb-3'>
            <label class='form-label'>".ucfirst($field)."</label>
            <input type='text' name='$field' class='form-control' value='$value' readonly>
          </div>";
  }

  // Add dropdown for Level (user input)
  echo "<div class='col-md-6 mb-3'>
          <label class='form-label'>Level</label>
          <select name='level' class='form-control' required>
            <option value=''>Select Level</option>
            <option value='700'>700</option>
            <option value='800'>800</option>
            <option value='900'>900</option>
          </select>
        </div>";

  // Add dropdown for Semester (user input)
  echo "<div class='col-md-6 mb-3'>
          <label class='form-label'>Semester</label>
          <select name='semester' class='form-control' required>
            <option value=''>Select Semester</option>
            <option value='FIRST'>FIRST</option>
            <option value='SECOND'>SECOND</option>
          </select>
        </div>";
  echo "</div>";

  
}
?>
