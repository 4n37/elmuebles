/*    $("button").click(function(){
        $("p").toggle();
    });
});*/
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

function hide_register_user(){
document.getElementById("user_register").style.display="none";
}

function hide_register_product(){
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

function step2() {
    //Change steps
    var step1 = document.getElementById("step1");
    step1.className = "w3-container w3-white";
    var step2 = document.getElementById("step2");
    step2.className = "w3-container w3-grey";
    var step3 = document.getElementById("step3");
    step3.className = "w3-container w3-white";

    document.getElementById("shopping_cart_table").style.display="none";
    document.getElementById("login_form").style.display="block";
    document.getElementById("payment").style.display="none";
    document.getElementById("step1_button").style.display="none";
    document.getElementById("step2_button").style.display="none";
}
function step3() {
  //Change steps
  var step1 = document.getElementById("step1");
  step1.className = "w3-container w3-white";
  var step2 = document.getElementById("step2");
  step2.className = "w3-container w3-white";
  var step3 = document.getElementById("step3");
  step3.className = "w3-container w3-grey";
  document.getElementById("login_form").style.display="none";
  document.getElementById("payment").style.display="block";
  document.getElementById("step2_button").style.display="none";
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
        $("<li>Email:"+users[i].email+"  </li>")
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
        $("<li>Product:"+products[i].P_Title_DE+"  </li>")
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
      $("#allorders").append(
        $("<li>Order:"+order[i].OrderNo+" Date: "+order[i].OrderDate+"</li>")
      );
    }
  },
})
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
