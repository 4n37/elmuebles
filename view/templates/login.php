<!-- User is logged in-->
<?php if(isset ($login)) { ?>

<div class="w3-container">
	<h2><?php echo I18n::get("welcome"); ?> <?php Controller::printCustomerName(); ?></h2>
	<form class="inline-form" action="index.php?action=updateUser" method="post">
		<p class="w3-container">E-Mail: <b><?php Controller::printCustomerEmail();?></b></p>
	  <p class="w3-container">Password: <b>********</b></p>
	  <p class="w3-container"><i>Name</i><input class="w3-input w3-white" name=customer[name] value=<?php Controller::printCustomerName();?> ></p>
	  <p class="w3-container"><i><?php echo I18n::get("surname"); ?></i><input class="w3-input w3-white" name=customer[surname] value=<?php Controller::printCustomerSurname();?> ></p>
	  <p class="w3-container"><i><?php echo I18n::get("street"); ?></i><input class="w3-input w3-white" name=customer[street] value=<?php Controller::printCustomerStreet();?>></p>
	  <p class="w3-container"><i><?php echo I18n::get("citycode"); ?></i><input class="w3-input w3-white" style="width:50%" name=customer[citycode] value=<?php Controller::printCustomerCitycode();?>></p>
	  <p class="w3-container"><i><?php echo I18n::get("city"); ?></i><input class="w3-input w3-white" name=customer[city] value=<?php Controller::printCustomerCity();?>></p>
		<p class="w3-container"><input class="w3-button w3-black" type="submit" value="<?php echo I18n::get("save"); ?>"></p>
		<input type="hidden" name="customer[id]" value="<?php echo $costumer->getCustomerNo()?>" />

	</form>
	</div>
<!-- User is not logged in-->
<?php } else{ ?>
<h3 class="w3-container"><?php echo I18n::get("login"); ?></h3>
<div class="w3-container">
<form class="inline-form" action="index.php?action=db_login" method="post" onsubmit="return validateForm();">
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
</div>

<?php } ?>
