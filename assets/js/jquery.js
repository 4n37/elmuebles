/** @file jquery.js
*
* @brief Javscript File
*
* @par
* COPYRIGHT NOTICE: (c) 2018 EL Muebles, Switzerland.
* All rights reserved.
*/

function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

function hide_register_user(){
  if(document.getElementById("user_register") !== null)
document.getElementById("user_register").style.display="none";
}

function hide_register_product(){
  if(document.getElementById("product_register") !== null)
  document.getElementById("product_register").style.display="none";
}

function show_register_user(){
document.getElementById("user_register").style.display="block";
}

function show_register_product(){
  document.getElementById("product_register").style.display="block";
  $("#allusers").empty();
  $("#allproducts").empty();
}

function showPayment(){
  if(document.getElementById("step1_button").style.display=="block")
  document.getElementById("step2_button").style.display="block";
}
function creditcard() {
  document.getElementById("creditcard").style.display="block";
  document.getElementById("bill").style.display="none";
}
function bill()
{
  document.getElementById("bill").style.display="block";
  document.getElementById("creditcard").style.display="none";
  var creditcard = document.getElementById("creditcard");
  $("#creditcard :input").prop("disabled", true);
}

function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
function showallUsers(){
  $("#allusers").empty();
 $.ajax({
  url: "index.php?action=getAllUsers",
  success: function (json){
    console.log(json);
    var users = JSON.parse(json);
    for(var i=0; i<users.length; i++){
      $("#allusers").append(
        $("<li>Email:"+users[i].email+" Name: "+users[i].Name+"  </li>")
      );
    }
  },
 })
}
function showallProducts(){
  $("#allproducts").empty();
 $.ajax({
  url: "index.php?action=getAllProducts",
  success: function (json){
    console.log(json);
    var products = JSON.parse(json);
    for(var i=0; i<products.length; i++){
      $("#allproducts").append(
        $("<li>Product: "+products[i].P_Title_DE+"  </li>")
      );
    }
  },
})
}
function showallOrders(){
  $("#allorders").empty();

 $.ajax({
  url: "index.php?action=getAllOrders",
  success: function (json){
    console.log(json);
    var order = JSON.parse(json);
    for(var i=0; i<order.length; i++){
      if(order[i].IsFinished==0){
        $("#allorders").append(
          $("<li>Order:"+order[i].OrderNo+" Date: "+order[i].OrderDate+" Customer: "+order[i].CustomerNo+"</li>")
        );
      }
      else{
        $("#allfinishedorders").append(
          $("<li>Order:"+order[i].OrderNo+" Date: "+order[i].OrderDate+" Customer: "+order[i].CustomerNo+"</li>")
        );
      }
    }
  },
})
}
function plusquantity(quantity){
  console.log(quantity+1);
  return quantity+1;
}
function validateForm() {
			// Validate email
			var email = form["email"].value;
			var regex = /\S+@\S+\.\S+/;
			if (!regex.test(email)) {
				alert("Please enter a valid e-mail address!");
				return false;
			}
      var pw = form["password"].value;
      var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$/;
      if (!regex.test(pw)) {
				alert("Please enter a valid password!");
				return false;
			}

			// Form is valid
			return true;
		}
