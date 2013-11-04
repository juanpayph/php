<?
 define("DEBUG", 1);
 define("USE_SANDBOX", 1);
 define('API_KEY', '6d2a252fbc221d087e1aa75e7182f3f5');
 define('JUANPAY_ACCOUNT_EMAIL', 'rtfiel@agile.com.ph');
 define("LOG_FILE", "/tmp/dpn.log");

 if (USE_SANDBOX==1) {
   define('JUANPAY_URL', 'https://sandbox.juanpay.ph');
 }
 else {
   define('JUANPAY_URL', 'https://www.juanpay.ph');
 }
?>
