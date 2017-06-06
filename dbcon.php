<?php
$mysqli = new mysqli('localhost','','','storedata');

//Output any connection error
if ($mysqli->connect_error) {
	die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>
