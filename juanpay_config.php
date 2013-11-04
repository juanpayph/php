<?
 define("DEBUG", 1);
 define("USE_SANDBOX", 1);
 define('API_KEY', 'e4fd617bfbce1a75fc9223a27950c130');
 define('JUANPAY_ACCOUNT_EMAIL', 'rtfiel@juanpay.ph');
 define("LOG_FILE", "/tmp/dpn.log");

 if (USE_SANDBOX==1) {
   #define('JUANPAY_URL', 'https://sandbox.juanpay.ph');
   define('JUANPAY_URL', 'http://localhost:3000');
 }
 else {
   define('JUANPAY_URL', 'https://www.juanpay.ph');
 }
?>
