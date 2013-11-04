<?
   function juanpay_hash($params) {
	$API_Key = "a4717475e363ce6790d013d1d8c7c0c4";
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

