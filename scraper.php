<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="ISO-8859-1">
<title>ITDC Project Home</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="css/index.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
<style>
.navbar-inverse { background-color: #000000}
.navbar-inverse .navbar-nav>.active>a:hover,.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus { background-color: #9C9C9C}
.navbar-inverse .navbar-nav>.active>a,.navbar-inverse .navbar-nav>.open>a,.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover,.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus { background-color: #080808}
.dropdown-menu { background-color: #000000}
.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus { background-color: #000000}
.navbar-inverse { background-image: none; }
.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus { background-image: none; }
.navbar-inverse { border-color: #000000}
.navbar-inverse .navbar-brand { color: #FCFCFC}
.navbar-inverse .navbar-brand:hover { color: #FCFCFC}
.navbar-inverse .navbar-nav>li>a { color: #FFFFFF}
.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus { color: #050505}
.navbar-inverse .navbar-nav>.active>a,.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus { color: #FFFFFF}
.navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus { color: #F5F5F5}
.dropdown-menu>li>a { color: #F0F0F0}
.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus { color: #808080}
.navbar-inverse .navbar-nav>.dropdown>a .caret { border-top-color: #000000}
.navbar-inverse .navbar-nav>.dropdown>a:hover .caret { border-top-color: #000000}
.navbar-inverse .navbar-nav>.dropdown>a .caret { border-bottom-color: #000000}
.navbar-inverse .navbar-nav>.dropdown>a:hover .caret { border-bottom-color: #000000}
.imacsearch{
float: right;
}
</style>
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="./" class="navbar-brand">Supervalu ITDC Project Home</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="index.php">Home</a>
        </li>
		<li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Metrics<b class="caret"></b></a>
	        <ul class="dropdown-menu">
	          <li><a href="itrmetrics.php">ITRC Metrics</a></li>
	          <li><a href="#">Imaging Metrics</a></li>
	        </ul>
	    </li>
      </ul>
      <ul class="nav navbar-nav" style="float: right">
      	<li>
	      	<form action="./scraper.php" Method="post" >
							<input type="text"
								onfocus="if(this.value == 'Enter a store number') { this.value = ''; }"
								value="Enter a store number" name="store" />
							<button type="submit">Search Imac Entries</button>
			</form>
		</li>
	  </ul>
    </nav>
  </div>
</header>
<div class="container">
<div class="table-responsive form-group row">
<?php
include('resources/scraper/SharePointAPI.php');
use Thybag\SharePointAPI;
$pageName = basename ( $_SERVER ['PHP_SELF'] );
$workingset = array ();
if (isset ( $_POST ['store'] )) {
	$store = $_POST ['store'];
}

/*
 * echo '<pre>';
 * var_dump ($data);
 * echo '</pre>';
 */
print"<table class='table'id='scrape'>;
		<thead>
		<th>Entered By</th>
		<th>Store Number</th>
		<th>Item Type</th>
		<th>Model</th>
		<th>Tracking</th>
		<th>Date this entry was created</th>
		<th>Date this entry was last modified</th>
		</thead>";
foreach ( $data as $value ) {	
	// 0 1 2 3 4
	if ($value['store_x0020_number'] == $store) {
		echo '<tr><td>';
		if (isset($value['title'])){
		echo$value['title'];
		}
		else {
		echo"N/A";
		}
		echo '</td><td>';
		if (isset($value['store_x0020_number'])){
		echo$value['store_x0020_number'];
		}
		else {
		echo"N/A";
		}
		echo'</td><td>';
		if (isset($value['item_x0020_type'])){
		echo$value['item_x0020_type'];
		}
		else {
		echo"N/A";
		}
		echo'</td><td>';
		if (isset($value['model_x0020_number'])){
		echo$value['model_x0020_number'];
		}
		else {
		echo"N/A";
		}
		echo'</td><td>';
		if (isset($value['tracking'])){
			if (substr ( $value['tracking'], 0, 2 ) == '1Z') {
				echo '<a href="https://wwwapps.ups.com/WebTracking/track?track=yes&trackNums=' . $value['tracking'] . '">' . $value['tracking'] . '</a>';
			} else {
				print_r ( $value['tracking'] );
			}
		}
		else{
			echo"N/A";
		}
		echo '</td><td>' . $value['created'] . '</td><td>' . $value['modified'] . '</td></tr>';
		echo str_repeat ( ' ', 2480 );
	}
}

echo '<form action="./projects.php" method="POST">';
echo '<input type="submit" value="Return to Search">';
echo '</form>';
?>
</table>
</div>
</div>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#scrape').DataTable();
    } );
    
    </script>
    <script>
    $(document).ready(function() {
                setInterval(function() {
                    var randomnumber = Math.floor(Math.random() * 100);
                    $('#ledger1').load("ledgerentry.php");}, 3000);
            });
	</script>
</body>
</html>