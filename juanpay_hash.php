<?
   function juanpay_hash($params) {
	$API_Key = "6d2a252fbc221d087e1aa75e7182f3f5";
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

