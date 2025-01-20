<?php
require_once("fun.inc.php");
$db_handle = new DBController();
if(!empty($_POST["faculty_id"])) {
	$query ="SELECT * FROM faculties_dept_spgs WHERE faculty_id = '" . $_POST["faculty_id"] . "' AND progtype='" . $_POST["progtype"] . "' ";
	$results = $db_handle->runQuery($query);
?>
	<option></option>
<?php
	foreach($results as $state) {
?>
	<option value="<?php echo $state["dept"]; ?>"><?php echo $state["dept"]; ?></option>
<?php
	}
}
?>