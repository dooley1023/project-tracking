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
				<a href="../../../index.php" class="navbar-brand">Supervalu ITDC Project Home</a>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse"
				role="navigation">
				<ul class="nav navbar-nav">
					<li><a href="../../../index.php">Home</a></li>
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
				</div>
				<div class="panel-body">
					<div class="table-responsive form-group row">
<?php
/* echo "<pre>";
echo var_dump(get_defined_vars());
echo "</pre>";  */
if (isset ($_GET['project'])){
$project = $_GET['project'];
}
if (isset ($_POST['project'])){
$project = $_POST['project'];
}
if (isset ($_POST['clear'])){
$notes = "";
$clearopen = fopen("Notes.txt","w+"); 
fwrite($clearopen,$notes."\n");
fclose($clearopen);
}
if (isset($_POST['update']) AND isset ($_POST['notes'])){
$open = fopen("Notes.txt","w+"); 
fwrite($open,$_POST['notes']); 
fclose($open);
}
if (file_exists("Notes.txt")){
$notes = file_get_contents("./Notes.txt");
}
if (isset($_GET['store'])){
$store = $_GET['store'];
}
if (isset($_POST['store'])){
$store = $_POST['store'];
}
if (isset ($_POST['update']) and isset ($_POST['notes'])){
$f = fopen("../master/master.txt", "r");
function trim_value(&$value) 
{ 
    $value = trim($value); 
}
/* echo "step 1"; */
$storevalues = array();
$storevalues['store'] = $_POST['store'];
$storevalues['rxpc'] = $_POST['rxpc'];
$storevalues['pc'] = $_POST['pc'];
$storevalues['ap'] = $_POST['ap'];
$storevalues['switches'] = $_POST['switches'];
$storevalues['Router'] = $_POST['Router'];
$storevalues['ESX'] = $_POST['ESX'];
$storevalues['DL160'] = $_POST['DL160'];
$storevalues['ISP'] = $_POST['ISP'];
$storevalues['1ship'] = $_POST['1ship'];
$storevalues['2ship'] = $_POST['2ship'];
echo "The values for ".$store ." have all been updated";
if (file_exists($store.".csv")){
$file = fopen($store.".csv","w");
fputcsv($file,$storevalues);
fclose($file);
}
echo '<form  method="POST">';
echo '<div class="main">';
echo '<table>';
echo '<tr>';
echo '<td>';
echo "How Many Regular PCs?";
echo '<br>';
echo '<input type="text" name=rxpc value='.$storevalues['rxpc'].'>';
echo '</td>';
echo '</div>';
echo '<div class=pc id=rxpc>';
echo '<td>';
echo "How Many RXPCs?";
echo '<br>';
echo '<input type="text" name=pc value='.$storevalues['pc'].'>';
echo '</td>';
echo '</div>';
echo '<div class=ap id=ap >';
echo '<td>';
echo "How Many APs?";
echo '<br>';
echo '<input type="text" name="ap" value='.$storevalues['ap'].'>';
echo '</td>';
echo '</div>';
echo '<div class=switch id=switch >';
echo '<td>';
echo "How Many Switches?";
echo '<br>';
echo '<input type="text" name=switches value='.$storevalues['switches'].'>';
echo '</td>';
echo '</div>';
echo '<div class=Router id=Router >';
echo '<td>';
echo "Router?";
echo '<br>';
echo '<input type="text" name=Router value='.$storevalues['Router'].'>';
echo '</td>';
echo '</div>';
echo '</tr>';
echo '<tr>';
echo '<div class=ESX id=ESX >';
echo '<td>';
echo "ESX Server?";
echo '<br>';
echo '<input type="text" name=ESX value='.$storevalues['ESX'].'>';
echo '</td>';
echo '</div>';
echo '<div class=DL160 id=DL160 >';
echo '<td>';
echo "DL160 Server?";
echo '<br>';
echo '<input type="text" name=DL160 value='.$storevalues['DL160'].'>';
echo '</td>';
echo '</div>';
echo '<div class=isp id=isp >';
echo '<td>';
echo "ISP Server?";
echo '<br>';
echo '<input type="text" name=ISP value='.$storevalues['ISP'].'>';
echo '</td>';
echo '</div>';
echo '<div class=1ship id=1ship >';
echo '<td>';
echo "1st ship date";
echo '<br>';
echo '<input type="text" name=1ship value='.$storevalues['1ship'].'>';
echo '</td>';
echo '</div>';
echo '<div class=2ship id=2ship >';
echo '<td>';
echo "1st ship date";
echo '<br>';
echo '<input type="text" name=2ship value='.$storevalues['2ship'].'>';
echo '</td>';
echo '</div>';
echo '</tr>';
echo '<tr>';
echo '<td colspan=10>';
echo "Current Notes.";
echo '<br>';
echo '<textarea name="notes" rows="10" id="notes">'.$notes.'';
echo '</textarea>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '<input type="hidden" name="store" value='.$store.'>';
echo '<button type="submit" name="update" method="post">';
echo 'Update';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '</button>';
echo '<button type="submit" name="clear" method="post">';
echo 'Clear Notes';
echo '</button>';
echo '</form>';

}
elseif (isset ($_GET['store']) and  isset($_GET['project'])){
$store = $_GET['store'];
$f = fopen($store.'.csv', "r");
function trim_value(&$value) 
{ 
    $value = trim($value); 
}
$storevalues = array();
while (!feof($f)) { 
$arrM = explode(",",fgets($f)); 
array_walk($arrM,'trim_value');
$value = (string) $arrM[0];
if (isset ($arrM[1]) AND isset ($store)){
if ($arrM[0] == $store){
/* echo "step 2"; */
$storevalues['store'] = $arrM[0];
$storevalues['rxpc'] = $arrM[1];
$storevalues['pc'] = $arrM[2];
$storevalues['ap'] = $arrM[3];
$storevalues['switches'] = $arrM[4];
$storevalues['Router'] = $arrM[5];
$storevalues['ESX'] = $arrM[6];
$storevalues['DL160'] = $arrM[7];
$storevalues['ISP'] = $arrM[8];
$storevalues['1ship'] = $arrM[9];
$storevalues['2ship'] = $arrM[10];
}
}
}
echo "We are updating values for ".$store .".";
if (!file_exists($store.".csv")){
fopen($store.".csv","w");
}
if (file_exists($store.".csv")){
$file = fopen($store.".csv","w");
fputcsv($file,$storevalues);
fclose($file);
}
echo '<form  method="POST">';
echo '<div class="main">';
echo '<table>';
echo '<tr>';
echo '<td>';
echo "How Many Regular PCs?";
echo '<br>';
echo '<input type="text" name=rxpc value='.$storevalues['rxpc'].'>';
echo '</td>';
echo '</div>';
echo '<div class=pc id=rxpc>';
echo '<td>';
echo "How Many RXPCs?";
echo '<br>';
echo '<input type="text" name=pc value='.$storevalues['pc'].'>';
echo '</td>';
echo '</div>';
echo '<div class=ap id=ap >';
echo '<td>';
echo "How Many APs?";
echo '<br>';
echo '<input type="text" name="ap" value='.$storevalues['ap'].'>';
echo '</td>';
echo '</div>';
echo '<div class=switch id=switch >';
echo '<td>';
echo "How Many Switches?";
echo '<br>';
echo '<input type="text" name=switches value='.$storevalues['switches'].'>';
echo '</td>';
echo '</div>';
echo '<div class=Router id=Router >';
echo '<td>';
echo "Router?";
echo '<br>';
echo '<input type="text" name=Router value='.$storevalues['Router'].'>';
echo '</td>';
echo '</div>';
echo '</tr>';
echo '<tr>';
echo '<div class=ESX id=ESX >';
echo '<td>';
echo "ESX Server?";
echo '<br>';
echo '<input type="text" name=ESX value='.$storevalues['ESX'].'>';
echo '</td>';
echo '</div>';
echo '<div class=DL160 id=DL160 >';
echo '<td>';
echo "DL160 Server?";
echo '<br>';
echo '<input type="text" name=DL160 value='.$storevalues['DL160'].'>';
echo '</td>';
echo '</div>';
echo '<div class=isp id=isp >';
echo '<td>';
echo "ISP Server?";
echo '<br>';
echo '<input type="text" name=ISP value='.$storevalues['ISP'].'>';
echo '</td>';
echo '</div>';
echo '<div class=1ship id=1ship >';
echo '<td>';
echo "1st ship date";
echo '<br>';
echo '<input type="text" name=1ship value='.$storevalues['1ship'].'>';
echo '</td>';
echo '</div>';
echo '<div class=2ship id=2ship >';
echo '<td>';
echo "1st ship date";
echo '<br>';
echo '<input type="text" name=2ship value='.$storevalues['2ship'].'>';
echo '</td>';
echo '</div>';
echo '</tr>';
echo '<tr>';
echo '<td colspan=10>';
echo "Current Notes.";
echo '<br>';
echo '<textarea name="notes" rows="10" id="notes">'.$notes.'';
echo '</textarea>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '<input type="hidden" name="store" value='.$store.'>';
echo '<button type="submit" name="update" method="post">';
echo 'Update';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '</button>';
echo '<button type="submit" name="clear" method="post">';
echo 'Clear Notes';
echo '</button>';
echo '</form>';
}

elseif (!isset ($_GET['store']) AND !isset($_POST['update'])){
echo 'Enter your store number<input type="text">';
$f = fopen("../master/master.txt", "r");
function trim_value(&$value) 
{ 
    $value = trim($value); 
}
$storevalues = array();
while (!feof($f)) { 
$arrM = explode(",",fgets($f)); 
array_walk($arrM,'trim_value');
$value = (string) $arrM[0];
if (isset ($arrM[1]) AND isset ($store)){
if ($arrM[0] == $store){
/* echo "step 3"; */
$storevalues['store'] = $arrM[0];
$storevalues['rxpc'] = $arrM[1];
$storevalues['pc'] = $arrM[2];
$storevalues['ap'] = $arrM[3];
$storevalues['switches'] = $arrM[4];
$storevalues['Router'] = $arrM[5];
$storevalues['ESX'] = $arrM[6];
$storevalues['DL160'] = $arrM[7];
$storevalues['ISP'] = $arrM[8];
$storevalues['1ship'] = $arrM[9];
$storevalues['2ship'] = $arrM[10];
}
}
}
fclose($f);
echo '<form  method="POST" id="mydata">';
echo '<div class="main">';
echo '<table>';
echo '<tr>';
echo '<td>';
echo '<div class=rxpc>';
echo "How Many Regular PCs?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=pc>';
echo '<td>';
echo "How Many Regular PCs";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=ap>';
echo '<td>';
echo "How Many APs?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=switch>';
echo '<td>';
echo "How Many Switches?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=Router id=Router >';
echo '<td>';
echo "Router?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '</tr>';
echo '<tr>';
echo '<div class=ESX>';
echo '<td>';
echo "ESX Server?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=DL160>';
echo '<td>';
echo "DL160 Server?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=isp>';
echo '<td>';
echo "ISP Server?";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=1ship>';
echo '<td>';
echo "first ship date";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '<div class=2ship>';
echo '<td>';
echo "second ship date";
echo '<br>';
echo '<input type="text">';
echo '</td>';
echo '</div>';
echo '</tr>';
echo '<tr>';
echo '<td colspan=10>';
echo "Enter notes here.";
echo '<br>';
echo '<textarea name="notes" form="mydata" rows="10" form="notes" id="notes">';
echo '</textarea>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '</form>';
echo '<input type="hidden" name="store" value='.$store.'>';
echo '<button type="submit" name="update" method="post">';
echo 'Update';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '</button>';
echo '<button type="submit" name="clear" method="post">';
echo 'Clear Notes';
echo '</button>';
echo '</form>';
}
?>
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
