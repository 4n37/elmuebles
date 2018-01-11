<div class="w3-row-padding ">
  <?php
  if(isset($products))
    foreach($products as $product){
  ?>

  <div class="w3-third w3-container w3-margin-bottom">
    <img src=<?php echo $product->getPicturesBig() ?> alt="Norway" style="width:100%" class="w3-hover-opacity">
    <div class="w3-container w3-white">
      <p><b><?php
      if(isset($_SESSION['lang']) && ($_SESSION['lang'] =="en"))
        echo $product->getTitleEN();
       else echo $product->getTitleDE(); ?></b></p>
      <p><?php if(isset($_SESSION['lang']) && ($_SESSION['lang'] =="en"))
        echo $product->getProductDescEN();
       else echo $product->getProductDescDE();  ?></p>
      <p>
        <form class="inline-form" action="index.php?action=addItemToCart" method="post">
          <button class="w3-button w3-white " name=row[ProdNo] value=<?php echo $product->getProdNo() ?>><i class="fa fa-shopping-cart"></i> <?php echo I18n::get("add_item"); ?></button>
          <!-- <button class="w3-button w3-white "><i class="fa fa-shopping-cart"></i> Schwarz</button> -->
        </form>
      </p>
    </div>
  </div>
<?php } ?>

</div>
