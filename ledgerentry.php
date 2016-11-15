<?php 
	
	$ledger = new SplFileObject ( '../../../Projects/ledger/itdc_ledger.csv' );
	$ledger->setFlags ( SplFileObject::READ_CSV );
	$ledger->seek ( PHP_INT_MAX );
	$ledger_line = $ledger->key ();
	$lines = new LimitIterator ( $ledger, $ledger_line - 50, $ledger_line );
	$entries = (iterator_to_array ( $lines ));
	print '<table class="table" id="ledger1">';
	echo "<thead>
		<tr>
		<th>Date Completed</th>
		<th>Computer Name</th>
		<th>Mac Address</th>
		<th>Serial Number</th>
		</tr>
		</thead>";
	
		foreach($entries as $entry)
			  {
						if (isset ($entry['4'])){
						echo "<tr><td>".$entry['0']."</td><td>".$entry['1']."</td><td>".$entry['2']."</td><td>".$entry['3']."</td></tr>";
						}
			  }

?>
<script>
$(document).ready(function() {
    $('#ledger1').DataTable({
		"order": [[ 0, "asec" ]]
	});
} );
</script>