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
div#data{
padding-top:15px;
position:relative;
display:inline-block;
}
div#butn{
padding-top:15px;
position:relative;
alighn:center;
margin:auto;
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
						</ul></li>
				</ul>
				<ul class="nav navbar-nav" style="float: right">
					<li>
						<form action="scraper.php" Method="post">
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
		<div class="panel-group" id="data">
			<form id="inputdata" method="post" class="form-horizontal text-left" action="">
				<div class="form-group">
					<label class="col-md-4 control-label">First choose the item you are working on</label>
					<div class="col-md-6 selectContainer">
						<select class="form-control" id="item" name="item"> 
						
				<?php
				require ('Classes/calendar/tc_calendar.php');
				
				$f = fopen ( "metrics/items.txt", "r" );
				
				// Read line by line until end of file
				while ( ! feof ( $f ) ) {
					
					// Make an array using comma as delimiter
					$arrM = explode ( ",", fgets ( $f ) );
					
					// w rite items to array for dropdown
					echo '<option value="'.strval($arrM [0]).'">' . $arrM [0] . '</option>';
				}
				
				fclose ( $f );
				
				?>
					</select>
					</div>
						<label class="col-md-4 control-label">How many have you completed?</label>
						<div class="col-md-6 selectContainer">
							<select class="form-control" id="numbers" name="numbers"> 
				<?php
				$counter = 0;
				
				do {
					
					echo '<option value=' . $counter . '>' . $counter . '</option>';
					
					$counter ++;
				} 

				while ( $counter <= 100 );
				?>
					</select> 
						</div>
							<button type="submit" class="btn btn-default">Submit</button>
					</div>
				</form>
			<?php
			date_default_timezone_set ( 'America/Denver' );
			
			if (isset ( $_POST ['item'] )) {
				
				if ($_POST ['item'] != "Choose one") {
					
					if ($_POST ['numbers'] != "Choose one") {
						
						$mEntry = date ( 'Y-m-d' ) . ',' . trim ( $_POST ['item'] ) . ',' . trim ( $_POST ['numbers'] );
						
						file_put_contents ( 'metrics/metrics.csv', trim ( $mEntry ) . PHP_EOL, FILE_APPEND );
					} 

					else {
						
						echo "Please select how many has been completed today";
					}
				} 

				else {
					
					echo "please enter the amount completed today";
				}
			}
			
			?>
			<div id="butn">
			<form action="search.php" method="POST">
					<input type="submit" value="Search For:"><Label for="fromdate">From
						Date</label><input id="fromdate" type="Date" name="fdate" /><Label
						for="todate">To Date</label><input id="todate" type="Date"
						name="tdate" />
				</form>
				</div>
		</div>
	</div>
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
	<script type="text/javascript">    $(document).ready(function() {        $('#main').DataTable();    } );    </script>
	<script type="text/javascript">(function($){    $(document).ready(function()    {        $.ajaxSetup(        {            cache: false,            beforeSend: function() {                $('#content').hide();                $('#loading').show();            },            complete: function() {                $('#loading').hide();                $('#content').show();            },            success: function() {                $('#loading').hide();                $('#content').show();            }        });        var $container = $("#ledger");        $container.load("ledgerentry.php");        var refreshId = setInterval(function()        {            $container.load('ledgerentry.php');        }, 30000);    });})(jQuery);</script>
</body>
</html>