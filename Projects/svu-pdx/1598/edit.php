<html>
<title>
</title>
<style>
textarea{
width: 100%;
height: 100px;
}
div{
width: auto;
}
table, th, td {
   border: 1px solid black;
}
</style>
<head>
</head>
<body>
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
$clearopen = fopen("./Notes.txt","w+"); 
fwrite($clearopen,$notes."\n");
fclose($clearopen);
}
if (isset($_POST['update']) AND isset ($_POST['notes'])){
$open = fopen("./Notes.txt","w+"); 
fwrite($open,$_POST['notes']); 
fclose($open);
}
if (file_exists("./Notes.txt")){
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
echo '<form method="post">';
echo "<div class='template'>";
echo '<button type="submit" name="template" method="post">';
echo 'Update Templates';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '</button>';
echo '</div>';
echo '</form>';
echo '<form action="../'.$project.'.php" method="post">';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '<button type="submit" name="return" method="post">';
echo "Return home";
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
echo '<form method="post">';
echo "<div class='template'>";
echo '<button type="submit" name="template" method="post">';
echo 'Update Templates';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '</button>';
echo '</div>';
echo '</form>';
echo '<form action="../'.$project.'.php" method="post">';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '<button type="submit" name="return" method="post">';
echo "Return home";
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
echo '<form method="post">';
echo "<div class='template'>";
echo '<button type="submit" name="template" method="post">';
echo 'Update Templates';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '</button>';
echo '</div>';
echo '</form>';
echo '<form action="../'.$project.'.php" method="post">';
echo '<input type="hidden" name="project" value="'.$project.'"/>';
echo '<button type="submit" name="return" method="post">';
echo "Return home";
echo '</form>';
}
echo '</body>';
echo '</html>';
?>