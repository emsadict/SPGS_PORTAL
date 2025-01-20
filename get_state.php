<?php
require_once("fun.inc.php");
$db_handle = new DBController();
if(!empty($_POST["country_id"])) {
	$query ="SELECT * FROM state2 WHERE state_id = '" . $_POST["country_id"] . "'";
	$results = $db_handle->runQuery($query);
?>
	<option></option>
<?php
	foreach($results as $state) {
?>
	<option value="<?php echo $state["lg"]; ?>"><?php echo $state["lg"]; ?></option>
<?php
	}
}
?>