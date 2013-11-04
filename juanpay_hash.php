<?
   include_once "juanpay_config.php";
   function juanpay_hash($params) {
	$API_Key = API_KEY;
	$md5HashData = $API_Key;
	$hashedvalue = '';
	foreach($params as $key => $value) {
	    if ($key<>'hash' && strlen($value) > 0) {
		$md5HashData .= $value;
	    }
	}
	if (strlen($API_Key) > 0) {
	    $hashedvalue .= strtoupper(md5($md5HashData));
	}
        return $hashedvalue; 
   }
  
?>

