<?php

include "juanpay_hash.php";
// CONFIG: Enable debug mode. This means we'll log requests into 'dpn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with DPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);

// Set to 0 once you're ready to go live
define("USE_SANDBOX", 1);


define("LOG_FILE", "/tmp/dpn.log");


// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}

$hashedvalue = juanpay_hash($_POST);
error_log(date('[Y-m-d H:i e] '). "hash value " . $hashedvalue . PHP_EOL, 3, LOG_FILE);
error_log(date('[Y-m-d H:i e] '). "_POST[hash] value " . $_POST['hash'] . PHP_EOL, 3, LOG_FILE);

if ($hashedvalue!=$_POST['hash']) {
  die('invalid hash');
}
$req = '';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "$key=$value&";
}

// Post DPN data back to JuanPay to validate the DPN data is genuine
// Without this step anyone can fake DPN data

if(USE_SANDBOX == true) {
	$juanpay_url = "https://sandbox.juanpay.ph/dpn/validate";
} else {
	$juanpay_url = "https://www.juanpay.ph/dpn/validate";
}

$ch = curl_init($juanpay_url);
if ($ch == FALSE) {
	return FALSE;
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}

// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.

//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);

$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to JuanPay to validate DPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;

} else {
		// Log the entire HTTP response if debug is switched on.
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for DPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);

			// Split response headers and payload
			list($headers, $res) = explode("\r\n\r\n", $res, 2);
		}
		curl_close($ch);
}

// Inspect DPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
	// check whether the payment_status is confirmed, underpaid, overpaid
	// check that message_id has not been previously processed
	// check that receiver_email is your JuanPay email
	// check that payment_amount
	// process payment and mark item as paid.

	// assign posted variables to local variables
        // $total = $_POST['total']
        // $message_id = $_POST['message_id']
        // $order_number = $_POST['order_number']
        // $ref_number = $_POST['ref_number']
        // $payer_email = $_POST['payer_email'] 
        // $status = $_POST['status'] 
	// $receiver_email = $_POST['receiver_email'];

 

	
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Verified DPN: $req ". PHP_EOL, 3, LOG_FILE);
		error_log(date('[Y-m-d H:i e] '). "Verified _POST DPN: ".print_r($_POST, true).PHP_EOL, 3, LOG_FILE);

	}
} else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
	// Add business logic here which deals with invalid DPN messages
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Invalid DPN: $req" . PHP_EOL, 3, LOG_FILE);
	}
}

?>
