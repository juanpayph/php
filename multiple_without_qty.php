<?
 include_once "juanpay_config.php";
?>
<html>
<form action="juanpay_post.php" method="post">
JuanPay Account Email <input type="text" name="email" value="<?=JUANPAY_ACCOUNT_EMAIL?>"><br>
Order Number  <input type="text" name="order_number" value="g123423dd222dd8"><br>
Form Option <input type="text" name="confirm_form_option" value="NONE"><br>
Item Name 1 <input type="text" name="item_name_1" value="White Pillow"><br>
Price 1 <input type="text" name="price_1" value="30"><br>
Item Name 2 <input type="text" name="item_name_2" value="Wallet"><br>
Price 2 <input type="text" name="price_2" value="10"><br>
Item Name 3 <input type="text" name="item_name_3" value="Belt"><br>
Price 3 <input type="text" name="price_3" value="23"><br>
Buyer Email <input type="text" name="buyer_email" value="ccfiel@gmail.com"><br>
Buyer First Name <input type="text" name="buyer_first_name" value="Chris Ian"><br>
Buyer Last Name <input type="text" name="buyer_last_name" value="Fiel"><br>
Buyer Mobile Number <input type="text" name="buyer_cell_number" value="09177048787"><br>
Online Store Return URL <input type="text" name="return_url" value="http://localhost/juanpay"><br>	
<input type="submit" name="submit_button">
</form>

</html>

