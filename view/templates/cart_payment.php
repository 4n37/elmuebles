<!--Step 1: Shopping Cart -->
	<div class="w3-third w3-container w3-margin-bottom" >
		<div id="step1" class="w3-container w3-white" >
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
		<div id="step3" class="w3-container w3-grey">
			<h5><?php echo I18n::get("step"); ?>  3</h5>
			<h3><?php echo I18n::get("delivery_payment"); ?> </h3>
		</div>
  </div>

  <div class="w3-container w3-margin-bottom">
    <div class="w3-white">
  <!-- Step 3 -> Delivery and Payment -->
  <div id="payment" class="w3-container"  >
  	<form class="inline-form w3-container w3-padding" action="index.php?action=send_order" method="post">
  	<h3><?php echo I18n::get("payment");?> </h3>
  		<input class="w3-radio  " type="radio" name="pay" value="creditcard" onclick="creditcard()" checked><?php echo I18n::get("creditcard");?><br>
  		<div id="creditcard" >
  				<p class="w3-container"><i><b><?php echo I18n::get("creditcardnumber");?></b></i><input type="text" class="w3-input w3-white"  name="creditcart[number]" required="required"></p>
    			<p class="w3-container"><i><b><?php echo I18n::get("expire");?></b></i><input class="w3-input" type="date" name="creditcard[date]" required="required" >
  				<p class="w3-container"><i><b>CVV</b></i><input type="text" class="w3-input w3-white"  name="creditcart[cvv]" type="number" min="3" max="3" required="required"></p>
  		</div>
  		<input class="w3-radio " type="radio" name="pay" value="bill" onclick="bill()"><?php echo I18n::get("invoice");?><br>
  		<div id="bill"></div>

  	<h4><?php echo I18n::get("order_overview");?></h4>
			<p><?php echo I18n::get("order_date"); ?></p>

			<!-- Step 1 -> Order Table -->
			<div class="w3-container w3-margin-bottom">
				<div class="w3-white">
					<table id="shopping_cart_table" class="w3-table">
					<tr>
					  <th><?php echo I18n::get("article"); ?></th>
					  <th><?php echo I18n::get("quantity"); ?></th>
					  <th><?php echo I18n::get("price"); ?></th>
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

							<!--http://wiki.selfhtml.org/wiki/HTML/Formulare/Button-->
					    <td><?php echo $quantity = $position->getQuantity();	?></td>

					  <td><b><?php echo Controller::printProductPrice($optno); ?></b></td>

					</tr>
					<?php } ?>
					</table>
		</div>
		</div>
  <h4><?php echo I18n::get("shipping_address");?></h4>
  	<p class="w3-container">E-Mail: <b><?php Controller::printCustomerEmail();?></b></p>
  	<p class="w3-container"><i>Name: <?php Controller::printCustomerName(); ?></i></p>
  	<p class="w3-container"><i><?php echo I18n::get("surname");?>: <?php Controller::printCustomerSurname();?></i></p>
  	<p class="w3-container"><i><?php echo I18n::get("street");?>: <?php Controller::printCustomerStreet();?></i></p>
  	<p class="w3-container"><i><?php echo I18n::get("citycode");?>: <?php  Controller::printCustomerCitycode();?></i></p>
  	<p class="w3-container"><i><?php echo I18n::get("city");?>: <?php Controller::printCustomerCity();?></i></p>
  	<p class="w3-container"><input class="w3-button w3-black" type="submit" value="<?php echo I18n::get("send");?>"></p>
  	</form>
  </div>
</div>
</div>
