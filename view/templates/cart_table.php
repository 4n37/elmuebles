<!--Step 1: Shopping Cart -->
	<div class="w3-third w3-container w3-margin-bottom" >
		<div id="step1" class="w3-container w3-grey" >
			<h5><?php echo I18n::get("step"); ?> 1</h5>
			<h3><?php echo I18n::get("shopping_cart"); ?> </h3>
		</div>
  </div>
<!--Step 2: Login -->
	<div class="w3-third w3-container w3-margin-bottom">
		<div id="step2" class="w3-container w3-white">
			<h5><?php echo I18n::get("step"); ?> 2</h5>
			<h3><?php echo I18n::get("to_login"); ?></h3>
		</div>
  </div>
<!--Step 3: Delivery and Payment -->
	<div class="w3-third w3-container w3-margin-bottom">
		<div id="step3" class="w3-container w3-white">
			<h5><?php echo I18n::get("step"); ?>  3</h5>
			<h3><?php echo I18n::get("delivery_payment"); ?> </h3>
		</div>
  </div>
<div class="w3-right w3-container">
  <form class="inline-form" action="index.php?action=cart_login" method="post" onsubmit="return validateForm();"name="p-data">
      <button  class="w3-button w3-red w3-margin" type="submit"> <i class="fa fa-arrow-right"><h3><?php echo I18n::get("checkout"); ?></h3></i></button>
  </form>
</div>

<div class="w3-container w3-margin-bottom">
  <div class="w3-white">

<!-- Anel get Products -->

<!-- Step 1 -> Shopping_cart -->
<table id="shopping_cart_table" class="w3-table">
<tr>
  <th><?php echo I18n::get("article"); ?></th>
  <th><?php echo I18n::get("quantity"); ?></th>
  <th><?php echo I18n::get("price"); ?></th>
  <th><?php echo I18n::get("delete"); ?></th>
</tr>
<?php
if(isset($orderposition))
			foreach($orderposition as $position){
				$ProdNo = $position->getProductNo();
				$optno = $position->getProductOptNo();
				//echo "ProdNo = {$ProdNo} & OptNo: {$optno}  ;  ";
  ?>
<tr>
  <td><?php echo Controller::printProductName($ProdNo)?></td>
  <td>
		<!--http://wiki.selfhtml.org/wiki/HTML/Formulare/Button-->
    <button class="w3-button w3-grey w3-margin "> <i class="fa fa-minus"></i></button><?php echo $quantity = $position->getQuantity();	?><button class="w3-button w3-grey w3-margin "> <i class="fa fa-plus"></i></button>
  </td>
  <td><b><?php echo Controller::printProductPrice($optno); ?></b></td>
  <td><button class="w3-button w3-black "> <i class="fa fa-trash"></i></button></td>
</tr>
<?php } ?>
</table>
</div>
</div>
