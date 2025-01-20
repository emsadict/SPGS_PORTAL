<?php
require_once("fun.inc.php");
$db_handle = new DBController();
if(!empty($_POST["preferredf_id"])) {
	$query ="SELECT * FROM faculties_dept WHERE faculty_id = '" . $_POST["preferredf_id"] . "'";
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