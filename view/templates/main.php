<!DOCTYPE html>
<!--
  Copyright (c) 2018 EL Muebles, Switzerland.

  Project 'EL Muebles'

  Lukas Hofer, Anel Becibergovic
 -->
<html>
  <head>

    <title>EL MUEBLES</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/image/favicon.ico">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/jquery.js"></script>

    <style>
      body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    </style>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay  w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
  </head>

    <!-- Header -->
    <header class="w3-main" style="margin-left:300px" id="portfolio">
      <a href="#"></a>
      <div class="w3-container">
        <div class="fa fa-bars w3-button w3-padding-32 w3-left" onclick="w3_open()"></div>
        <div onclick="location.href='index.php';"><h1>EL Muebles</h1></div>
        <div class="w3-section w3-padding">

          <form class="inline-form" action="index.php?action=search"  method="post">
            <span class=" w3-margin-right"><?php echo I18n::get("search"); ?></span>
            <input class=" w3-button w3-white" style="width:380px" name=search></input>
            <button class="w3-button w3-white "><i class="fa fa-search"></i></button>
          </form>

          <form class="inline-form" action="index.php?action=shopping_cart" method="post">
            <button <?php if ($this->controller->isOrder()) {?> class=" w3-button w3-green" <i class="fa fa-shopping-cart"</i> <?php } else{?> class="w3-button w3-white" ><?php }?> <i class="fa fa-shopping-cart"></i></button>
          </form>
          <form class="inline-form" action="index.php?action=login" method="post">
              <button  <?php if ($this->controller->isLoggedIn()) {?> class=" w3-button w3-green" <i class="fa fa-user"</i> <?php } else{?> class="w3-button w3-white" ><?php }?>  <i class="fa fa-user "></i></button>
      	  </form>
          <?php if(isset($_SESSION['admin'])){?>
            <form class="inline-form" action="index.php?action=admin" method="post">
              <button class="w3-button w3-white "> <i class="fa fa-user"></i></button>
            </form>
          <?php }?>
          <div class="inline-form"><?php if ($this->controller->isLoggedIn()) {?>
            <p>&raquo; <a href="index.php?action=logout"><?php echo I18n::get("to_logout");?></a></p><?php }?>
          </div>
       </div>
     </div>
    </header>


  <!-- Body -->
  <body class="w3-light-grey w3-content" style="max-width:1600px" onload="{hide_register_product(); hide_register_user()};">
    <div class="w3-main w3-container" style="margin-left:300px">
      <!-- Error Handling -->
      <?php if(isset($error)):?><div class="w3-container w3-red " style="max-width:350px"><?php  echo $error; ?></div><br><?php endif; ?>

       <?php
       //Load Template
       include($innerTpl); ?>
    </div>


  </body>

  <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-bar-block w3-card-2 w3-top w3-xlarge w3-animate-left" style="display:none;z-index:3;width:300px;" id="mySidebar"><br>
      <div class="w3-container">
        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
          <i class="fa fa-remove"></i>
        </a>
        <h4><br><br><b>PORTFOLIO</b></h4>
      </div>
      <div class="w3-bar-block">
        <a href="index.php?action=show_sofa" onclick="w3_close()" class="w3-bar-item w3-button w3-padding "><i class="fa fa-bed fa-fw w3-margin-right"></i>Sofas</a>
        <a href="index.php?action=show_tables" onclick="w3_close()" class="w3-bar-item w3-button w3-padding "><i class="fa fa-square  fa-fw w3-margin-right"></i><?php echo I18n::get("tables"); ?></a>
        <a href="index.php?action=show_chairs" onclick="w3_close()" class="w3-bar-item w3-button w3-padding "><i class="fa fa-th-large fa-fw w3-margin-right"></i><?php echo I18n::get("chairs"); ?></a>
        <a href="index.php?action=show_shiners" onclick="w3_close()" class="w3-bar-item w3-button w3-padding "><i class="fa fa-lightbulb-o fa-fw w3-margin-right"></i><?php echo I18n::get("shiners"); ?></a>
      </div>
    </nav>

  <!-- Footer -->
  <footer class="w3-main w3-card w3-container w3-padding-32 w3-dark-grey" style="margin-left:300px">
    <div class="w3-row-padding">
      <div class="w3-third">
        <h3><?php echo I18n::get("slogan"); ?></h3>
        <div class="w3-panel">
          <p>Kornquaderweg 54 </p>
          <p>8913 Rickenbach </p>
          <p>shop@elmuebles.ch</p>
        </div>
        <div class="w3-panel w3-large">
          <i class="fa fa-facebook-official w3-hover-opacity"></i>
          <i class="fa fa-instagram w3-hover-opacity"></i>
          <i class="fa fa-snapchat w3-hover-opacity"></i>
          <i class="fa fa-pinterest-p w3-hover-opacity"></i>
          <i class="fa fa-twitter w3-hover-opacity"></i>
          <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
      </div>

      <div class="w3-third">
        <a href="https://www.mastercard.com" target="_blanked">
          <img src="assets/image/Mastercard_Logo.png" style="width:30%" class="w3-hover-opacity">
        </a>
        <a href="https://www.visaeurope.ch" target="_blanked">
          <img src="assets/image/Visa_Logo.png"  style="width:30%" class="w3-hover-opacity">
        </a>
        <a href="https://www.paypal.com" target="_blanked">
          <img src="assets/image/Paypal_Logo.png"  style="width:30%" class="w3-hover-opacity">
        </a>
      </div>

      <div class="w3-third">
        <div>
          <p>© 2018 ELMUEBLES</p>
          <p>Lukas Hofer, Anel Becibergovic</p>
          <p><?php echo I18n::get("layout"); ?><a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
          <form class="inline-form" action="index.php?action=DE" method="post">
            <input class="w3-button w3-white" type="submit" value="DE"></p>
          </form>
          <form class="inline-form" action="index.php?action=EN" method="post">
            <input class="w3-button w3-white" type="submit" value="EN"></p>
          </form>
        </div>
      </div>
    </div>

  </footer>
</html>
