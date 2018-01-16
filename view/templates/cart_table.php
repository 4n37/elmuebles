<!--Step 1: Shopping Cart -->
	<div class="w3-third w3-container w3-margin-bottom" >
		<div class="w3-container w3-grey" >
			<h5><?php echo I18n::get("step"); ?> 1</h5>
			<h3><?php echo I18n::get("shopping_cart"); ?> </h3>
		</div>
  </div>
<!--Step 2: Login -->
	<div class="w3-third w3-container w3-margin-bottom">
		<div class="w3-container w3-white">
			<h5><?php echo I18n::get("step"); ?> 2</h5>
			<h3><?php echo I18n::get("to_login"); ?></h3>
		</div>
  </div>
<!--Step 3: Delivery and Payment -->
	<div class="w3-third w3-container w3-margin-bottom">
		<div class="w3-container w3-white">
			<h5><?php echo I18n::get("step"); ?>  3</h5>
			<h3><?php echo I18n::get("delivery_payment"); ?> </h3>
		</div>
  </div>
<div class="w3-right w3-container">
	<?php
		if(isset($orderposition)){ ?>
  	<form class="inline-form" action="index.php?action=cart_login" method="post" name="p-data">
      <button  class="w3-button w3-red w3-margin" type="submit"> <i class="fa fa-arrow-right"><h3><?php echo I18n::get("checkout"); ?></h3></i></button>
  	</form>
	<?php }?>
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
				$OrderNo = $position->getOrderNo();
				$PosNo = $position->getPosNo();
				//echo "ProdNo = {$ProdNo} & OptNo: {$optno}  ;  ";
  ?>
<tr>
  <td><?php echo Controller::printProductName($ProdNo)?></td>
  <td>
		<form class="inline-form" action="index.php?action=decQuantity" method="post">
			<button class="w3-button w3-grey w3-margin "> <i class="fa fa-minus"></i></button>
			<input type="hidden" name="pos_no" value="<?php echo $PosNo;?>" />
		</form>
		<?php echo $quantity = $position->getQuantity();	?>
		<form class="inline-form" action="index.php?action=incQuantity" method="post">
			<button class="w3-button w3-grey w3-margin "> <i class="fa fa-plus"></i></button>
			<input type="hidden" name="pos_no" value="<?php echo $PosNo;?>" />
		</form>
  </td>
  <td><b><?php echo Controller::printProductPrice($optno,$OrderNo); ?></b></td>
	<form class="inline-form" action="index.php?action=removeProduct" method="post">
  	<td><button class="w3-button w3-black "  name="posno" value="<?php echo $position->getPosNo();	?>"> <i class="fa fa-trash"> </i></button></td>
	</form>
</tr>
<?php } ?>
</table>
</div>
</div>
