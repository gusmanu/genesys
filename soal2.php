<?php

$x=5;

for($i=1; $i<=$x; $i++){
	for($j=$x; $j>=$i; $j-=1){
		echo '&nbsp';
	}
	for($k=1; $k<=$i; $k++){
		echo '*';
	}
	echo '<br>';
}

?>