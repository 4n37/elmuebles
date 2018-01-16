<!--Step 1: Shopping Cart -->
	<div class="w3-third w3-container w3-margin-bottom" >
		<div class="w3-container w3-white" >
			<h5><?php echo I18n::get("step"); ?> 1</h5>
			<h3><?php echo I18n::get("shopping_cart"); ?> </h3>
		</div>
  </div>
<!--Step 2: Login -->
	<div class="w3-third w3-container w3-margin-bottom">
		<div class="w3-container w3-grey">
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

 <?php if(isset($login)){ ?>
  <div class="w3-right w3-container">
    <form class="inline-form" action="index.php?action=cart_payment" method="post" onsubmit="return validateForm();"name="p-data">
        <button  class="w3-button w3-red w3-margin" type="submit"> <i class="fa fa-arrow-right"><h3><?php echo I18n::get("checkout"); ?></h3></i></button>
    </form>
  </div>
 <?php } ?>


  <div class="w3-container w3-margin-bottom">
    <div class="w3-white">
  <!-- Step 2 -> Login -->
  <div id="login_form" class="w3-container" >
    <?php if(!isset($login)){ ?>
      <h3 ><?php echo I18n::get("login"); ?></h3>
      <form class="inline-form" action="index.php?action=ct_login" method="post" onsubmit="return validateForm();">
      	<div class="w3-container"><p><label class="w3-input" style="width:10%" ><?php echo I18n::get("username"); ?></label>
      		<input name="username" required="required" ></p>
      	</div>
      	<div class="w3-container"<p><label class="w3-input" style="width:10%">Password</label>
      		<input type="password" required="required" name="pw"></p>
      	</div>
      	<p class="w3-container"><input class="w3-button w3-black" type="submit" value="Login"></p>
      </form>
      <form class="inline-form" action="index.php?action=register" method="post">
      	<p class="w3-container"><input class="w3-button w3-black" type="submit" value="<?php echo I18n::get("register"); ?>"></p>
      </form>
    <?php } else{ ?>
      <form  class="inline-form" action="index.php?action=ct_updateUser" method="post">
        <p class="w3-container">E-Mail: <b><?php Controller::printCustomerEmail();?></b></p>
        <p class="w3-container"><i>Name</i><input class="w3-input w3-white" name=customer[name] value=<?php if(isset ($login)) Controller::printCustomerName();?> required="required"></p>
        <p class="w3-container"><i><?php echo I18n::get("surname"); ?></i><input class="w3-input w3-white" name=customer[surname] value=<?php if(isset ($login)) Controller::printCustomerSurname();?> required="required"></p>
        <p class="w3-container"><i><?php echo I18n::get("street"); ?></i><input class="w3-input w3-white" name=customer[street] value=<?php if(isset ($login)) Controller::printCustomerStreet();?> required="required"></p>
        <p class="w3-container"><i><?php echo I18n::get("citycode"); ?></i><input class="w3-input w3-white" style="width:50%" name=customer[citycode] value=<?php if(isset ($login)) Controller::printCustomerCitycode();?> required="required"></p>
        <p class="w3-container"><i><?php echo I18n::get("city"); ?></i><input class="w3-input w3-white" name=customer[city] value=<?php if(isset ($login)) Controller::printCustomerCity();?> required="required"></p>
        <p class="w3-container"><input class="w3-button w3-black" type="submit" value="<?php echo I18n::get("save"); ?>"></p>
      </form>
    <?php } ?>
  </div>
</div>
</div>
