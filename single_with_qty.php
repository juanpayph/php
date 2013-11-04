<?
 include_once "juanpay_config.php";
?>

<html>
<form action="juanpay_post.php" method="post">
JuanPay Account Email <input type="text" name="email" value="<?=JUANPAY_ACCOUNT_EMAIL?>"><br>
Order Number <input type="text" name="order_number" value="3gd323sfjg"><br>
Form Option <input type="text" name="confirm_form_option" value="WITH_OUT_SHIPPING_ADD"><br>
Item Name <input type="text" name="item_name_1" value="White Pillow"><br>
Quantity <input type="text" name="qty_1" value="5"><br>
Price <input type="text" name="price_1" value="30"><br>
Buyer Email <input type="text" name="buyer_email" value="ccfiel@gmail.com"><br>
Buyer First Name <input type="text" name="buyer_first_name" value="Chris Ian"><br>
Buyer Last Name <input type="text" name="buyer_last_name" value="Fiel"><br>
Buyer Mobile Number <input type="text" name="buyer_cell_number" value="09177048787"><br>
<input type="submit" name="submit_button">
</form>

</html>

