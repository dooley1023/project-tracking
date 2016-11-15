<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="ISO-8859-1">
<title>ITDC Project Home</title>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="css/index.css" rel="stylesheet">
<link
	href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"
	rel="stylesheet">
<link
	href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
	rel="stylesheet" />
<style type="text/css">
.navbar-inverse {
	background-color: #000000
}

.navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>li>a:hover,
	.navbar-inverse .navbar-nav>li>a:focus {
	background-color: #9C9C9C
}

.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.open>a,
	.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover,
	.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover,
	.navbar-inverse .navbar-nav>.open>a:focus {
	background-color: #080808
}

.dropdown-menu {
	background-color: #000000
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
	background-color: #000000
}

.navbar-inverse {
	background-image: none;
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
	background-image: none;
}

.navbar-inverse {
	border-color: #000000
}

.navbar-inverse .navbar-brand {
	color: #FCFCFC
}

.navbar-inverse .navbar-brand:hover {
	color: #FCFCFC
}

.navbar-inverse .navbar-nav>li>a {
	color: #FFFFFF
}

.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus
	{
	color: #050505
}

.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.open>a,
	.navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus
	{
	color: #FFFFFF
}

.navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus
	{
	color: #F5F5F5
}

.dropdown-menu>li>a {
	color: #F0F0F0
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
	color: #808080
}

.navbar-inverse .navbar-nav>.dropdown>a .caret {
	border-top-color: #000000
}

.navbar-inverse .navbar-nav>.dropdown>a:hover .caret {
	border-top-color: #000000
}

.navbar-inverse .navbar-nav>.dropdown>a .caret {
	border-bottom-color: #000000
}

.navbar-inverse .navbar-nav>.dropdown>a:hover .caret {
	border-bottom-color: #000000
}

.imacsearch {
	float: right;
}

.panel-refresh {
	height: 250px;
	position: relative;
}

.refresh-container {
	position: absolute;
	top: 0;
	right: 0;
	background: rgba(200, 200, 200, 0.25);
	width: 100%;
	height: 100%;
	display: none;
	text-align: center;
	z-index: 4;
}

.refresh-spinner {
	padding: 30px;
	opacity: 0.8;
}
</style>
</head>
<body>
	<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav"
		role="banner">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse"
					data-target=".bs-navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a href="index.php" class="navbar-brand">Supervalu ITDC Project Home</a>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse"
				role="navigation">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Metrics<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="itrcmetrics.php">ITRC Metrics</a></li>
							<li><a href="imaging-metrics.php">Imaging Metrics</a></li>
							<li><a href="./admin/index.php">Administration</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav" style="float: right">
					<li>
						<form action="./scraper.php" Method="post">
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
	<div class="panel panel-default">
		<div class="panel-heading">Supervalu ITRC Metrics</div>
		<div class="panel-body">
			<div class="table-responsive row" id="metrics">
				<table class="table sortable" id="main">
				<thead>
				
					<tr>
						<th>
							<form action="itrcmetrics/upload.html">
								<input type="hidden" name="metrics" value="metrics" />
								<button type="submit">ITRC Metrics Upload</button>
							</form>
						</th>
						<th>
						Date Last Modified
						</th>
						</tr>
					</thead>
<?php
$template = './templates/genmet.php';
function trim_value(&$value) {
	$value = trim ( $value );
}

$f = fopen ( "itrcmetrics/itrcmetrics/dates.txt", "r" );

while ( ! feof ( $f ) ) {
	$arrM = explode ( ",", fgets ( $f ) );
	array_walk ( $arrM, 'trim_value' );
	$value = ( string ) $arrM [0];
	if (! empty ( $value )) {
		echo "<tr><td>";
		echo '<form action="itrcmetrics/' . $value . '.php">';
		echo '<input type="hidden" name="project" value="'.$value.'">';
		echo '<button type="submit" class="btn btn-primary">'.$value .'</button>';
		echo "</form>";
		echo '</td>';
		echo '<td>';
		echo "Last modified: ".date("F d Y H:i:s.",filemtime('itrcmetrics/' . $value . '.php'));
		echo "</td></tr>";
	}
}

fclose ( $f );
?>

				</table>
			</div>
			<div></div>
			<!-- Placed at the end of the document so the pages load faster -->
			<script
				src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"
				type="text/javascript"></script>
			<script
				src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
				type="text/javascript"></script>
			<script
				src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"
				type="text/javascript"></script>
			<script
				src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"
				type="text/javascript"></script>
			<script
				src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"
				type="text/javascript"></script>
		<script type="text/javascript">
	    $(document).ready(function() {
	        $('#main').DataTable();
	    } );
	    </script>
    </script>

		</div>
	</div>
</body>
</html>