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
							<li><a href="#">Imaging Metrics</a></li>
						</ul></li>
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
	<div class="container">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">Create New Porject
				
				</div>
				<form  action="#" method="POST" id="mydata">
				<input class="form-control" type="text" placeholder="Project Name here" id="project" name="Project">
				<br>
				<br>
				<p>Enter your store numbers below</p>
				<p>Each store should be seperated by a comma.</p>
				<textarea class="form-control" rows="20"  id="stores" name="stores" placeholder="EXAMPLE: 01234, 56789, 12345, 85234"></textarea>
				</div>
			<input type="submit" class="btn btn-info" name="create" value="Create Project">
			</button>
	
<?php 

/**
 * * @Trim Value * * @param [in] $Value in * @return trimmed value * * @details trims unexpected white spaces or returns
 */
function trim_value(&$value) {
	$value = trim ( $value );
}
if (isset ($_POST['create'] )) {
	
	$project = $_POST['Project'];
	
	if (! file_exists ( 'projects/'. $project . '/' )) {
		
		mkdir ('projects/'.  $project . '/', 0777, true );
		
		mkdir ( 'projects/'. $project . '/master', 0777, true );
		
		$file = fopen ('projects/'.  $project . '/master/master.txt', "w" );
		
		fclose ( $file );
		
		$f = fopen ('projects.txt', "a" );
		
		fwrite ( $f, "\n" . $_POST ['Project'] . "," );
		
		fclose ( $f );
	}
}

/**
 * * * * * * @details generates project files if they are not currently present based on provided store numbers.
 */

if (isset ( $_POST ['Project'] )) {
	
	if (!file_exists ( 'projects/'. $project . '/' . $project . '.php' )) {
		
		copy ( 'templates/project.php', 'projects/'. $project . '/' . $project . '.php' );
	}
	
	if (isset ( $_POST ['stores'] ) and isset ( $_POST ['create'] )) {
		
		$storevalues = explode ( ",", $_POST['stores'] );
		
		array_walk ( $storevalues, 'trim_value' );
		
		foreach ( $storevalues as $value ) {
			
			if (! file_exists ( 'projects/'. $project . '/' . $value . '/' )) {
				
				mkdir ( 'projects/'. $project . '/' . $value . '/', 0777, true );
			}
			
			if (! file_exists ( 'projects/'. $project . '/' . $value . '/edit.php' )) {
				
				copy ( 'templates/edit.php','projects/'.  $project . '/' . $value . '/edit.php' );
			}
			
			if (! file_exists ('projects/'. $project . '/' . $value . '/' . $value . '.csv' )) {
				
				$file = fopen ( 'projects/'. $project . '/' . $value . '/' . $value . '.csv', "w" );
				
				fclose ( $file );
			}
			
			/* echo "<pre>"; var_dump(get_defined_vars()); echo "</pre>"; */
			
			if (file_exists ( 'projects/'. $project . '/master/master.txt' )) {
				
				$file = fopen ( 'projects/'. $project . '/master/master.txt', "a" );
				
				fwrite ( $file, $value .  "," . ",". "," . "," . "," . "," . "," . "," . "," . "," . "\n" );
				
				fclose ( $file );
			}
			
			if (file_exists ('projects/'. $project . '/' . $value . '/' . $value . '.csv' )) {
				
				$storedata = $value . "," . "," . "," . "," . "," . "," . "," . "," . "," . ",";
				
				if (file_exists ( 'projects/'. $project . '/' . $value . '/' . $value . '.csv' )) {
					
					$v = fopen ('projects/'.  $project . '/' . $value . '/' . $value . '.csv', "w" );
					
					fwrite ( $v, $storedata );
					
					fclose ( $v );
					
					echo '<script type="text/javascript">						window.location = "http://itdcduplicator/projectstest/projectshome/dbtest/workingdb/projects/' . $project . '/' . $project . '.php?project=' . $project . '";						</script>';
				}
			}
		}
	}
}
?>	
</form>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"
		type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
		type="text/javascript"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"
		type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"
		type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"
		type="text/javascript"></script>
</body>
</html>