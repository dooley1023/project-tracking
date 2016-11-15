<?php 
echo '<form metho="post">';
echo '<input type="number" name="range1" min="1" max="99999">';
echo '<input type="number" name="range2" min="1" max="99999">';
echo '<input type="submit" value="Submit">';
echo '</form>';	
if (isset($_GET["range1"])){
$start = $_GET["range1"];
$end = $_GET["range2"];
}
while($start < $end){
	echo $start.'<br/>';
	$start ++;
}
?>