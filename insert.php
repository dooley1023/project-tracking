<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>ITDC ProjectInsert Data insert</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="css/index.css" rel="stylesheet">
</head>
<body>
<?php
require 'dbcon.php';
$id = "''";
//echo '<pre>';
//var_dump($_POST['Store']);
if (isset($_POST['Store'])){
	$store = $_POST['Store'];
}
if (isset($_POST['Banner'])){
	$banner = $_POST['Banner'];
}
if (isset($_POST['Project'])){
	$project = $_POST['Project'];
}
if($store == 'xxxxx'){
	echo '<p>Were sorry the store number has been entered incorrectly!</p>';
print'<a class="btn btn-primary" href="insert.html" role="button">Return to insert data</a>';
	exit();
}
if($banner == 'xxxxx'){
echo '<p>Were sorry the banner has been entered incorrectly!</p>';
	print'<a class="btn btn-primary" href="insert.html" role="button">Return to insert data</a>';
	exit();
}
if($project == 'xxxxx'){
	echo '<p>Were sorry the project has been entered incorrectly!</p>';
	print'<a class="btn btn-primary" href="insert.html" role="button">Return to insert data</a>';
	exit();
}
if (strlen($store) == 5){
	$insert = 'INSERT INTO entry (id, store, banner, project) VALUES ('.$id.', "'.$store.'", "'.$banner.'", "'.$project.'")';
	if ($mysqli->query($insert) === TRUE) {
		echo '<p>New record created successfully<p>';
	}
		else {
			echo "Error: " . $insert . "<br>" . $mysqli->error;
		}
	}
	
	print'<a class="btn btn-primary" href="index.php" role="button">Return to home page</a>';
	// close connection
	$mysqli->close();

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