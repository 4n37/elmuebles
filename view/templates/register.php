<h4 class="w3-container"><?php echo I18n::get("new_user"); ?></h4>
<form class="inline-form" action="index.php?action=insert_customer" method="post" onsubmit="return validateForm();"name="p-data">
  <p class="w3-container"><i><b>E-Mail</b></i><input type="text" class="w3-input w3-white"  name="customer[email]" required="required"></p>
  <p class="w3-container"><i><b>Password</b></i><input type="password" class="w3-input w3-white" name=customer[password] required="required" ></p>
  <p class="w3-container"><i>Name</i><input class="w3-input w3-white" name=customer[name]></p>
  <p class="w3-container"><i><?php echo I18n::get("surname"); ?></i><input class="w3-input w3-white" name=customer[surname]></p>
  <p class="w3-container"><i><?php echo I18n::get("street"); ?></i><input class="w3-input w3-white" name=customer[street]></p>
  <p class="w3-container"><i><?php echo I18n::get("citycode"); ?></i><input class="w3-input w3-white" style="width:50%" name=customer[citycode]></p>
  <p class="w3-container"><i><?php echo I18n::get("city"); ?></i><input class="w3-input w3-white" name=customer[city]></p>
  <p class="w3-container"><input class="w3-button w3-black" type="submit" value="<?php echo I18n::get("register"); ?>"></p>
  <input type="hidden" name="customer[id]" value="<?php echo $costumer->getCustomerNo()?>" />
</form>
