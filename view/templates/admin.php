<!--

Da dies der Admin Bereich ist wird auf eine Formvalidierung verzichtet (Aufgrund Zeitmangel)

 -->

<title>Admin Zone </title>
<div class="w3-row-padding">
  <div class="w3-third w3-container w3-margin-bottom">
    <div class="w3-container w3-white">
      <p><b><?php echo I18n::get("orders"); ?></b></p>
      <p><a href="#" onclick="showallOrders()"><?php echo I18n::get("all_orders"); ?></a> </p>
        <ul id="allorders"></ul>
    </div>
  </div>
  <div class="w3-third w3-container w3-margin-bottom">
    <div class="w3-container w3-white">
      <p><b><?php echo I18n::get("products"); ?></b></p>
      <div class="w3-button w3-black" onclick="{show_register_product(); hide_register_user();}"><a><?php echo I18n::get("new_product"); ?></a></div>
      <p><a href="#" onclick="showallProducts()" ><?php echo I18n::get("all_product"); ?></a> </p>
          <ul id="allproducts"></ul>
    </div>
  </div>
</div>
<div class="w3-row-padding">
  <div class="w3-third w3-container w3-margin-bottom">
    <div class="w3-container w3-white">
      <p><b><?php echo I18n::get("user"); ?></b></p>
      <form action="index.php?action=register" method="post">
      	<p ><input class="w3-button w3-black" type="submit" value="<?php echo I18n::get("new_user"); ?>"></p>
      </form>
      <p><a href="#" onclick="showallUsers()"><?php echo I18n::get("all_users"); ?></a> </p>
        <ul id="allusers"></ul>
    </div>
  </div>
  <div class="w3-third w3-container w3-margin-bottom">
    <div class="w3-container w3-white">
      <p><b><?php echo I18n::get("settings"); ?></b></p>
      <p><?php echo I18n::get("username"); ?> <b><?php Controller::printCustomerEmail();?></b>  </p>
    </div>
  </div>
</div>

<div id="product_register" class=" w3-container w3-margin">
  <h4 ><?php echo I18n::get("new_product_h4"); ?></h4>
  <form class="inline-form" action="index.php?action=insert_product" method="post">
    <select class=" w3-select  " name="product[category]" required="required">
      <option value="1">Sofa</option>
      <option value="2"><?php echo I18n::get("tables"); ?></option>
      <option value="3">Sofa</option>
      <option value="4"><?php echo I18n::get("shiners"); ?></option>
    </select>
    <br><br>
    <p class="w3-container"><b><?php echo I18n::get("title"); ?> [DE]</b><input class="w3-input w3-white" name=product[title_de]  required="required"></p>
    <p class="w3-container"><b><?php echo I18n::get("title"); ?> [EN]</b><input class="w3-input w3-white" name=product[title_en]  required="required"></p>
    <p class="w3-container"><?php echo I18n::get("desc"); ?> [DE]<input class="w3-input w3-white " name=product[desc_de] ></p>
    <p class="w3-container"><?php echo I18n::get("desc"); ?> [EN]<input class="w3-input w3-white " name=product[desc_en] ></p>
    <p class="w3-container"><?php echo I18n::get("image"); ?> Link [Big]<input class="w3-input w3-white " name=product[pic_big] ></p>
    <p class="w3-container"><?php echo I18n::get("image"); ?> Link [Small]<input class="w3-input w3-white " name=product[pic_small] ></p>
    <p class="w3-container"><b><?php echo I18n::get("price"); ?></b><input class="w3-input w3-white " name=product[price]  required="required" ></p>
    <p class="w3-container"><?php echo I18n::get("color"); ?><input class="w3-input w3-white " name=product[color] ></p>
    <button class=" w3-button w3-black "><?php echo I18n::get("save"); ?></button>
  </form>
</div>

<div id="user_register" class="user_register w3-container"
  <p>Neuer Benutzer</p>
  <form class="w3-padding" action="index.php?action=insert_user" method="post">
  </form>
</div>
