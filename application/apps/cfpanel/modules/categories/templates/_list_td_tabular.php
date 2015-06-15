<?php 
	echo ($categories['level'] ==0 ) ? '<b>'.$categories['name'].'</b>' : str_repeat('&nbsp;',($categories['level']*4)).$categories['name'] 
?>

