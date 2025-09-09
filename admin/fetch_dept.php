<?php
require_once("../fun.inc.php"); // Adjust path if needed
$db_handle = new DBController();

if (!empty($_POST["school"])) {
    $school = $_POST["school"];
    $query = "SELECT DISTINCT dept FROM course WHERE school = '" . $school . "'";
    $results = $db_handle->runQuery($query);
?>
    <option value="">Select Department</option>
<?php
    foreach ($results as $row) {
?>
    <option value="<?php echo $row["dept"]; ?>"><?php echo $row["dept"]; ?></option>
<?php
    }
}
?>
