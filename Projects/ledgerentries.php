<html>
<style>
table, th, td {
   border: 1px solid black;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
<head>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'>";
</script>
</head>
<body>
<div>
<?php
try{
/**
 *  @Trim Value
 *  
 *  @param [in] $Value in 
 *  @return trimmed value 
 *  
 *  @details trims unexpected white spaces or returns
 */
	function trim_value(&$ledgervalue) 
	{ 
		$value = trim($ledgervalue); 
	}
	/**
	 *  
	 *  
	 * 
	 *  
	 *  @details gets store value from POST and determines if it needs to be lengthened to 5 digit store number
	 */
	if (isset ($_GET['store'])){
	$store = $_GET['store'];
	if (strlen($store) < 4 AND strlen($store) == 3){
		$store = "00".$store;
		echo "Mac Entries for store ".$store;
	}
	/**
	 *  
	 *  
	 * 
	 *  
	 *  @details gets store value from POST and determines if it needs to be lengthened to 5 digit store number
	 */
	if (strlen($store)< 5 AND strlen($store) == 4){
	$store = "0".$store;
	echo "Mac Entries for store ".$store;
	}
	/**
	 *  
	 *  
	 * 
	 *  
	 *  @details pulls ledger data and creates structured array 
	 */
	$ledger = fopen("./ledger/itdc_ledger.csv","r");
	/**
	 *  
	 *  
	 * 
	 *  
	 *  @details generates a table and all required table structures
	 */
	echo "<table>";
	echo "<tr><td>Date Completed</td><td>Computer Name</td><td>Mac Address</td><td>Serial Number</td></tr>";
	/**
	 *  
	 *  
	 * 
	 *  
	 *  @details parses through ledger data looking for provided store details.
	 *  it then generates a row for each entry found.
	 */
	while(!feof($ledger))
		  {
				$ledgervalue = explode(",",fgets($ledger));
					if (isset ($ledgervalue['4'])){
					if(mb_convert_encoding($ledgervalue['4'],'UTF-8','UCS-2') == $store){
					echo "<tr><td>".mb_convert_encoding($ledgervalue['0'],'UTF-8','UCS-2')."</td><td>".mb_convert_encoding($ledgervalue['1'],'UTF-8','UCS-2')."</td><td>".mb_convert_encoding($ledgervalue['2'],'UTF-8','UCS-2')."</td><td>".mb_convert_encoding($ledgervalue['3'],'UTF-8','UCS-2')."</td></tr>";
					}
					}
		  }

		fclose($ledger);
	}
}
catch(exception $e) {
echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
</table>
</div>
</body>
<html>
