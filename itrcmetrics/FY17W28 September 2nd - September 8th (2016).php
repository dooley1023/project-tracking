<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="ISO-8859-1">
<title>ITDC Project Home</title>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="../css/index.css" rel="stylesheet">
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

.target {
	display: none;
}
th, td {
border: 1px solid black;
}
th, td {
padding:10px;
}
td{
width: 50%;
}
table{
width: 100%;
}
</style>
<script src='js/sorttable.js' type="text/javascript">
";
</script>
<style type="text/css">
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
				<a href="../index.php" class="navbar-brand">Supervalu ITDC Project
					Home</a>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse"
				role="navigation">
				<ul class="nav navbar-nav">
					<li><a href="../index.php">Home</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Metrics<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="../itrcmetrics.php">ITRC Metrics</a></li>
							<li><a href="../imaging-metrics.php">Imaging Metrics</a></li>
						</ul></li>
				</ul>
				<ul class="nav navbar-nav" style="float: right">
					<li>
						<form action="scraper.php" Method="POST">
							<input type="text"
								onfocus="if(this.value == 'Enter a store number') { this.value == ''; }"
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

				<table class="table" id="main">
					<thead>
						<tr>
							<th>
								<form action="upload.html">
									<input type="hidden" name="metrics" value="metrics" />
									<button type="submit">ITRC Metrics Upload</button>
								</form>
							</th>
						</tr>
					</thead>

				</table>

				<button id="button">Toggle displaying tickets</button>
				<div class="target" id="target">
<?php
// all requests
$totalRequests = array ();
$resRequests = array ();
// all change orders
$totalChange = array ();
$resChange = array ();
// all problems
$totalProblem = array ();
$resProblem = array ();
// all incidents
$totalIncident = array ();
$resIncident = array ();
// working set
$arrR = array ();

if (isset ( $_GET ['project'] )) {
	$project = $_GET ['project'];
}
if (isset ( $_POST ['project'] )) {
	$project = $_POST ['project'];
}
function trim_value(&$value) {
	$value = trim ( $value );
}

// split csv into its elements
$fR = fopen ( "./inputfiles/" . $project . ".csv", "r" );
while ( ! feof ( $fR ) ) {
	$tempR = (fgetcsv ( $fR ));
	$arrR [] = array (
			$tempR [11],
			$tempR [1],
			$tempR [2],
			$tempR [3],
			$tempR [4],
			$tempR [5],
			$tempR [6],
			$tempR [7],
			$tempR [8],
			$tempR [9],
			$tempR [10],
			$tempR [0],
			$tempR [12],
			$tempR [13],
			$tempR [14],
			$tempR [15],
			$tempR [16],
			$tempR [17] 
	);
}
foreach ( $arrR as $values ) {
	if ($values [14] == 'Request') {
		$Requests [] = $values [0];
	}
	if ($values [14] == 'Change Order') {
		$Change [] = $values [0];
	}
	if ($values [14] == 'Problem') {
		$Problem [] = $values [0];
	}
	if ($values [14] == 'Incident') {
		$Incident [] = $values [0];
	}
}
if (! isset ( $Requests )) {
	$Requests = 0;
	$rnoarr = 1;
}
if (! isset ( $Change )) {
	$Change = 0;
	$cnoarr = 1;
}
if (! isset ( $Problem )) {
	$Problem = 0;
	$pnoarr = 0;
}
if (! isset ( $Incident )) {
	$Incident = 0;
	$inoarr = 1;
}
fclose ( $fR );
// end splitting elements
// break into each unique subset
$Requestexist = 0;
$Problemexist = 0;
$Incidentexist = 0;
$Changeexist = 0;
if (isset ( $Requests ) && $Requests != 0) {
	$uni_request = array_unique ( $Requests );
	$Requestexist = 1;
}
if (isset ( $Requests ) && $Requests == 0) {
	$uni_request = 0;
}
if (! isset ( $Requests )) {
	$uni_request = 0;
	$Requestexist = 1;
}
if (isset ( $Problem ) && $Problem != 0) {
	$uni_problem = array_unique ( $Problem );
	$Problemexist = 1;
}
if (isset ( $Problem ) && $Problem == 0) {
	$uni_problem = 0;
}
if (! isset ( $Problem )) {
	$uni_problem = 0;
	$Problemexist = 1;
}
if (isset ( $Change ) && $Change != 0) {
	$uni_change = array_unique ( $Change );
	$Changeexist = 1;
}
if (isset ( $Change ) && $Change == 0) {
	$uni_change = 0;
}
if (! isset ( $Change )) {
	$uni_change = 0;
	$Requestexist = 1;
}
if (isset ( $Incident ) && $Incident != 0) {
	$uni_incident = array_unique ( $Incident );
	$Incidentexist = 1;
}
if (isset ( $Incident ) && $Incident == 0) {
	$uni_incident = 0;
}
if (! isset ( $Incident )) {
	$uni_incident = 0;
	$Incidentexist = 1;
}

echo '<pre>';
/*
 * var_dump($Requestexist);
 * var_dump($Problemexist);
 * var_dump($Changeexist);
 * var_dump($Incidentexist);
 */
/*
 * if (isset($uni_request)){
 * var_dump($uni_request);
 * }
 * if (isset($uni_change)){
 * var_dump($uni_change);
 * }
 * if (isset($uni_problem)){
 * var_dump($uni_problem);
 * }
 * if (isset($uni_incident)){
 * var_dump($uni_incident);
 * }
 */
echo '</pre>';
if ($Requestexist == 1) {
	$head = 0;
	$totals = 0;
	foreach ( $uni_request as $value ) {
		foreach ( $arrR as $match ) {
			if ($value == $match [0]) {
				if ($Requestexist == 1) {
					if ($head == 0) {
						echo '<p>Resolved Requests</p>';
						echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Request Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			";
						$head ++;
					}
					if ($match [14] == 'Request' && $match [8] == 'L2 IT Request Center' && $match [16] == 'Resolved' || $match [16] == 'Closed') {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$resRequests [] = array (
								$match [0],
								$match [3],
								$match [8],
								$match [16]
						);
					} else if ($totals == 0) {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}else {
						/* echo "
						 <tr>
						 <td>0</td>
						 <td>0</td>
						 <td>0</td>
						 </tr>
						 "; */
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}
				}
			}
		}
	}
}
if (isset ( $inoarr ) && ($inoarr == 1)) {
	$head = 0;
	if ($head == 0) {
		echo '<p>Other Requests</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Request Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
if ($uni_request == 0) {
	$head = 0;
	if ($head = 0) {
		echo '<p>Other Requests</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Request Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
echo '</table>';
echo '<br>';
if ($Changeexist == 1) {
	$head = 0;
	$totals = 0;
	foreach ( $uni_change as $value ) {
		foreach ( $arrR as $match ) {
			if ($value == $match [0]) {
				if ($Changeexist == 1) {
					if ($head == 0) {
						echo '<p>Resolved Changes</p>';
						echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Change Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			";
						$head ++;
					}
					if ($match [14] == 'Change' && $match [8] == 'L2 IT Request Center' && $match [16] == 'Resolved' || $match [16] == 'Closed') {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$resChanges [] = array (
								$match [0],
								$match [3],
								$match [8],
								$match [16]
						);
					} else if ($totals == 0) {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}else {
						/* echo "
						 <tr>
						 <td>0</td>
						 <td>0</td>
						 <td>0</td>
						 </tr>
						 "; */
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}
				}
			}
		}
	}
}
if (isset ( $inoarr ) && ($inoarr == 1)) {
	$head = 0;
	if ($head == 0) {
		echo '<p>Other Changes</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Change Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
if ($uni_change == 0) {
	$head = 0;
	if ($head = 0) {
		echo '<p>Other Changes</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Change Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
echo '</table>';
echo '<br>';
if ($Problemexist == 1) {
	$head = 0;
	$totals = 0;
	foreach ( $uni_problem as $value ) {
		foreach ( $arrR as $match ) {
			if ($value == $match [0]) {
				if ($Problemexist == 1) {
					if ($head == 0) {
						echo '<p>Resolved Problems</p>';
						echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Problem Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			";
						$head ++;
					}
					if ($match [14] == 'Problem' && $match [8] == 'L2 IT Request Center' && $match [16] == 'Resolved' || $match [16] == 'Closed') {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$resProblems [] = array (
								$match [0],
								$match [3],
								$match [8],
								$match [16]
						);
					} else if ($totals == 0) {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}else {
						/* echo "
						 <tr>
						 <td>0</td>
						 <td>0</td>
						 <td>0</td>
						 </tr>
						 "; */
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}
				}
			}
		}
	}
}
if (isset ( $inoarr ) && ($inoarr == 1)) {
	$head = 0;
	if ($head == 0) {
		echo '<p>Other Problems</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Problem Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
if ($uni_problem == 0) {
	$head = 0;
	if ($head = 0) {
		echo '<p>Other Problems</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Problem Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
echo '</table>';
echo '<br>';
if ($Incidentexist == 1) {
	$head = 0;
	$totals = 0;
	foreach ( $uni_incident as $value ) {
		foreach ( $arrR as $match ) {
			if ($value == $match [0]) {
				if ($Incidentexist == 1) {
					if ($head == 0) {
						echo '<p>Resolved Incidents</p>';
						echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Incident Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			";
						$head ++;
					}
					if ($match [14] == 'Incident' && $match [8] == 'L2 IT Request Center' && $match [16] == 'Resolved' || $match [16] == 'Closed') {
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$resIncidents [] = array (
								$match [0],
								$match [3],
								$match [8],
								$match [16] 
						);
					} else if ($totals == 0) { 
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
					}else {
						/* echo "
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			"; */
						echo '<tr><td>' . $match [3] . '</td><td>' . $match [0] . '</td><td>' . $match [8] . '</td><td>' . $match [16] . '</td></tr>';
						$head ++;
						$totals ++;
						}
					}
				}
			}
		}
	}
if (isset ( $inoarr ) && ($inoarr == 1)) {
	$head = 0;
	if ($head == 0) {
		echo '<p>Other Incidents</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Incident Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
if ($uni_incident == 0) {
	$head = 0;
	if ($head = 0) {
		echo '<p>Other Incidents</p>';
		echo "<table id='main' class='sortable'>
			<thead>
			<tr>
			<th>Analyst Name</th>
			<th>Incident Number</th>
			<th>Group Name</th><th>Status</th>
			</tr>
			</thead>
			<tr>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			</tr>
			</thead>
			";
		$head ++;
	}
}
echo '</table>';
echo '<br>';
?>
<p>Above this line are the values we are calculating for each item.
						Below it are the totals</p>
					<br>
					<p>-----------------------------------------------------------------------------------------</p>
				</div>
<?php
if ($Requestexist == 1) {
	$resolvedTR = count ( $resRequests );
	$totalR = count ( $uni_request );
	echo "<table id=='main' class=='sortable'>
					<thead>
					<tr>
					<th>Total Requests</th>
					<th>Total Resolved Requests </th>
					</tr>
					</thead>";
	echo '<tr><td>' . $totalR . '</td><td>' . $resolvedTR . '</td></tr>';
	echo '</table>';
} else {
	echo '<table class="sortable">
			<thead>
			<tr>
			<th>Total Requests</th>
			<th>Total Resolved Requests</th>
			</tr>
			</thead>';
	echo '<tr>
					<td>0</td>
					<td>0</td>
					</tr>';
	echo '</table>';
}
if ($Problemexist == 1) {
	$resolvedTotP = count ( $resProblem );
	$totalP = count ( $uni_problem );
	echo "<table id='main' class='sortable'>
	<thead>
	<tr>
	<th>Total Problems</th>
	<th>Total Resolved Problems</th>
	<tr>
		</thead>";
	echo '<tr><td>' . $totalP . '</td><td>' . $resolvedTotP . '</td></tr>';
	echo '</table>';
} else {
	echo '<table class="sortable">
			<thead>
			<tr>
			<th>Total Problems</th>
			<th>Total Resolved Problems</th>
			</tr>
			</thead>';
	echo '<tr>
					<td>0</td>
					<td>0</td>
					</tr>';
	echo '</table>';
}
if ($Changeexist == 1) {
	$resolvedTotC = count ( $resChange );
	$totalCO = count ( $uni_change );
	echo '<table class="sortable">
			<thead>
			<tr>
			<th>Total Change Orders</th>
			<th>Total Resolved Change Orders</th>
			</tr>
			</thead>';
	echo '<tr><td>' . $totalCO . '</td><td>' . $resolvedTotC . '</td></tr>';
	echo '</table>';
} else {
	echo '<table class="sortable">
							<thead>
							<tr>
							<th>Total Change Orders</th>
							<th>Total Resolved Change Orders </th>
							</tr>
							</thead>';
	echo '<tr>
					<td>0</td>
					<td>0</td>
					</tr>';
	echo '</table>';
}
if ($Incidentexist == 1) {
	$resolvedI = count ( $resIncident );
	$totalTI = count ( $uni_incident );
	echo '<table class="sortable">
				<thead>
				<tr>
				<th>Total Incidents</th>
				<th>Total Resolved Incidents</th>
				</tr>
				</thead>';
	echo '<tr><td>' . $totalTI . '</td><td>' . $resolvedI . '</td></tr>';
	echo '</table>';
} else {
	echo '<table class="sortable">
			<thead>
			<tr>
			<th>Total Incidents</th>
			<th>Total Resolved Incidents</th>
			</tr>
			</thead>';
	echo '<tr>
					<td>0</td>
					<td>0</td>
					</tr>';
	echo '</table>';
}
?>		
			</div>
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
	<script type="text/javascript">
document.getElementById('button').addEventListener('click', function () {
    toggle(document.querySelectorAll('.target'));
});

function toggle (elements, specifiedDisplay) {
  var element, index;

  elements = elements.length ? elements : [elements];
  for (index = 0; index < elements.length; index++) {
    element = elements[index];

    if (isElementHidden(element)) {
      element.style.display = '';

      // If the element is still hidden after removing the inline display
      if (isElementHidden(element)) {
        element.style.display = specifiedDisplay || 'block';
      }
    } else {
      element.style.display = 'none';
    }
  }
  function isElementHidden (element) {
    return window.getComputedStyle(element, null).getPropertyValue('display') === 'none';
  }
}
</script>


</body>
</html>