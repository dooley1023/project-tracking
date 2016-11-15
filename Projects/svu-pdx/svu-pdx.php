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
.navbar{
padding-top: 10px;
position: relative;
}
</style>
</head>
<body>
	<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
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
					<li><a href="../index.php">Home</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Metrics<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="itrcmetrics.php">ITRC Metrics</a></li>
							<li><a href="imaging-metrics.php">Imaging Metrics</a></li>
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
				<div class="panel-heading">Supervalu Projects
				<form action="genproj.php">
				<button type="submit" class="btn btn-primary">Create New Project</button>
				</form>
				</div>
				<div class="panel-body">
					<div class="table-responsive form-group row">
<?php
if (isset ($_GET['project'])){
	$project = $_GET['project'];
}
if (isset ($_POST['project'])){
	$project = $_POST['project'];
}
/*  echo "<pre>";
 echo var_dump(get_defined_vars());
 echo "</pre>";  */
$currentproj = basename(getcwd());
$template  = '../templates/edit.php';
$f = fopen("./master/master.txt", "r");
$statuses = array();
function trim_value(&$value) 
{ 
    $value = trim($value); 
}
/**
 *  
 *  
 *  
 *  
 *  
 *  @details parses text file and explodes each entry on a comma then adds to a structured array. 
 */
echo "<table id='main' class='sortable'>
			<thead>
			<th>Store Number</th>
			<th>Number of Regular PCs to be done</th>
			<th>Number of RX PCs to be done</th>
			<th>Access Points</td><td>Switches</th>
			<th>Router</td><td>ESX</td><td>DL160</th>
			<th>ISP</td><td>first ship date</th>
			<th>second ship date</th>
			<th>current status</th>
			<th>Get Ledger Entries</th>
			</thead>
			<tr>";
while (!feof($f)) { 
$arrM = explode(",",fgets($f)); 
array_walk($arrM,'trim_value');
$value = (string) $arrM[0];
if (isset ($_POST['template'])){
copy($template,'./'.$arrM[0].'/edit.php');
}
if (!file_exists('./'.$value)){
mkdir('./'.$value,0777,true);
}
if (!file_exists("./".$value.'/status.txt')){
fopen("./".$value.'/status.txt',"w");
}
if (!file_exists("./".$value.'/Notes.txt')){
$file = fopen("./".$value.'/Notes.txt', "w");
fclose($file);
}
if (file_exists("./".$value.'/Notes.txt')){
$notes = file_get_contents("./".$value.'/Notes.txt');
if (is_null ($notes)){
$notes = "";
}
}
if (isset ($arrM[1])){
if(!file_exists("./".$arrM[0]."/".$arrM[0].".csv")){
$file = fopen("./".$arrM[0]."/".$arrM[0].".csv","w");
fputcsv($file,$arrM);
fclose($file);
}
$file = fopen("./".$arrM[0]."/".$arrM[0].".csv", "r");
$contents = fgetcsv($file);
/* echo "<pre>";
print_r ($contents);
echo "</pre>"; */ 
echo '<td><input id="Button" value='.$contents[0].' type="submit" onclick="window.location.href=\'./'.$contents[0].'/edit.php?project='.$project.'&store='.$contents[0]. '\'" /></td><td>'.$contents[1].'<td>'.$contents[2].'</td><td>'.$contents[3].'</td><td>'.$contents[4].'</td><td>'.$contents[5].'</td><td>'.$contents[6].'</td><td>'.$contents[7].'</td><td>'.$contents[8].'</td><td>'.$contents[9].'</td><td>'.$contents[10].'</td><td>'.$notes.'</td><td><input id="Button" value="Get Ledger Entries"'.$contents[0].'" type="submit" onclick="window.location.href=\'../ledgerentries.php?store='.$contents[0].'\'"></td></tr>';
}
}
fclose($file);
fclose($f);
?>
<div id= "wrapper">
<?php
if (isset ($_GET['project'])){
$project = $_GET['project'];
}
if (isset ($_POST['project'])){
$project = $_POST['project'];
}
echo '<form method="post">';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
?>
</div>
		</div>
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
    $(document).ready(function() {
        $('#main').DataTable();
    } );
    </script>
	<script type="text/javascript">
(function($)
{
    $(document).ready(function()
    {
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#content').show();
            },
            success: function() {
                $('#loading').hide();
                $('#content').show();
            }
        });
        var $container = $("#ledger");
        $container.load("ledgerentry.php");
        var refreshId = setInterval(function()
        {
            $container.load('ledgerentry.php');
        }, 30000);
    });
})(jQuery);
</script>

</body>
</html>
