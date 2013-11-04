<?php
    include_once "juanpay_config.php";
    include_once "juanpay_hash.php";
    ksort($_POST);
    $hashedvalue = juanpay_hash($_POST);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="no-store, no-cache, must-revalidate">
<META HTTP-EQUIV="PRAGMA" CONTENT="no-store, no-cache, must-revalidate">
<body onload="document.order.submit()">
<body>
	<form name="order" action="<?=JUANPAY_URL?>/checkout"  method="post">
	<?	
		foreach($_POST as $key => $value) {
			if (strlen($value) > 0) {
	?>
        	<input type="hidden" name="<?=$key?>" value="<?=$value?>"/><br>
	<?             
    			}
		}
	?>		
    	<input type="hidden" name="hash" value="<?=$hashedvalue?>"/>
	</form>
</body>
</html>


