<html>
<style>
table, th, td {
   border: 1px solid black;
}
tr:nth-child(even) {background-color: #f2f2f2}
.template{
	 float:left;
}
.home{
	 float:left;
}
.wrapper{
	vertical-align:top;
}
body{
	float:left;
}
</style>
<head>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'>";
</script>
</head>
<body>
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
echo "<table><tr><td>Store Number</td><td>Number of RX PCs to be done</td><td>Number of Office PCs to be done</td><td>Switches</td><td>Router</td><td>ESX</td><td>DL160</td><td>ISP</td><td>current status</td><td>Get Ledger Entries</td></tr><tr>";
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
echo "</pre>";  */
echo '<td><input id="Button" value='.$contents[0].' type="submit" onclick="window.location.href=\'./'.$contents[0].'/edit.php?project='.$project.'&store='.$contents[0]. '\'" /></td><td>'.$contents[1].'<td>'.$contents[2].'</td><td>'.$contents[3].'</td><td>'.$contents[4].'</td><td>'.$contents[5].'</td><td>'.$contents[6].'</td><td>'.$contents[7].'</td><td>'.$notes.'</td><td><input id="Button" value="Get Ledger Entries"'.$contents[0].'" type="submit" onclick="window.location.href=\'../ledgerentries.php?store='.$contents[0].'\'"></td></tr>';
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
<div class='template'>
<button type="submit" name="template" method="post">
Update Templates
</button>
</div>
</form>
<div id ="home">
<form action="../../projects.php">
<div class='home'>
<button type="submit" name="home" method="post">
Return Home
</button>
</div>
</div>
</form>
</body>
<html>
