<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>ITDC ProjectInsert Delete entry</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="css/index.css" rel="stylesheet">
</head>
<body>
<?php
require 'dbcon.php';
//echo '<pre>';
//var_dump(get_defined_vars());
if (isset($_POST['id'])){
	$id = $_POST['id'];
	$store = $_POST['store'];
	$banner = $_POST['banner'];
	$project = $_POST['project'];
	print'<p>Preparing to delete entry!</p>';
	print '<p>'.$id.' '.$store.' '.$banner.' '.$project.'</p>';
	$delete = "DELETE FROM entry WHERE id=$id";
	//echo $delete;
	if ($mysqli->query($delete) === TRUE) {
		echo '<p>Entry Successfully deleted!<p>';
	}
	else {
		echo "Error: " . $delete . "<br>" . $mysqli->error;
	}
	$mysqli->close();
}
else{
	print'<p>id is missing unable to complete you transaction!</p>';
	print'<a class="btn btn-primary" href="index.php" role="button">Return to home page</a>';
	exit();
}
	print'<a class="btn btn-primary" href="index.php" role="button">Return to home page</a>';


?>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>