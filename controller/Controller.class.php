<?php

class Controller {

	private $data = array();
	private $sessionState = false;
	private $title = '';
	public $language = 'de';

	// A C T I O N S
	public function home(Request $request) {
		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ProdNo';
		$sort = $request->getParameter('sort', 'ProdNo');
		$products = Product::getProducts($sort);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_products");
			return "home";
		}
		else $this->data["products"] = $products;
		//Inititalize Order
		Order::init();
		$this->title = "Home";
	}
	public function create_product(Request $request) {
		$this->data["message"] = "create new product";
		if($this->IsAdmin())return "admin";
		return $this->page403();
	}

	public function register(Request $request) {
		return "register";
	}

	public function login(Request $request){
		$this->startSession();
		if(isset($_SESSION['user'])) {
        $this->data["login"] = "Logged in";
    }
		return "login";
	}

	public function db_login(Request $request){
		$username = $request->getParameter('username', '');
		$pw = $request->getParameter('pw', '');
		if ( preg_match('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/',$username)) {
		} else {
			$this->data["error"] = I18n::get("enter_valid_email");
				return "login";
		}
		if (is_null($user = Customer::checkAuthorization($username, $pw))){
			$this->data["error"] = I18n::get("wrong_username");
			return "login";
		}
		$this->startSession();
		$_SESSION['user'] = $username;
		$this->data["login"] = "Logged in";
		//Look if user is admin
		if($user->getIsAdmin()==1){
			$_SESSION['admin'] = $username;
			$this->data["admin"] = "Logged in";
		}
		return "login";
	}
	public function ct_login(Request $request){
		$username = $request->getParameter('username', '');
		$pw = $request->getParameter('pw', '');
		if ( preg_match('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/',$username)) {
		} else {
			$this->data["error"] = I18n::get("enter_valid_email");
				return "cart_login";
		}
		if (is_null($user = Customer::checkAuthorization($username, $pw))){
			$this->data["error"] = I18n::get("wrong_username");
			return "cart_login";
		}
		$this->startSession();
		$_SESSION['user'] = $username;
		$this->data["login"] = "Logged in";
		//Look if user is admin
		if($user->getIsAdmin()==1){
			$_SESSION['admin'] = $username;
			$this->data["admin"] = "Logged in";
		}
		return "cart_login";
	}

	public function admin(Request $request) {
		if($this->IsAdmin())return "admin";
		return $this->page403();
	}

	public function logout(Request $request) {
		$this->startSession();
		session_destroy();
		$_SESSION = array();

		$this->data["error"] = I18n::get("logout");
		return "login";
	}

	public function shopping_cart(Request $request){
		$OrderNo = $_SESSION['orderNo'];
		$orderposition = Orderpositions::getOrderPositions($OrderNo);
		if(empty($orderposition)){
			$this->data["error"] = I18n::get("no_orders");
			return "cart_table";
		}
		else $this->data["orderposition"] = $orderposition;
		//print_r($orderposition);

		return "cart_table";

	}

	public function insert_customer(Request $request){
		$values = $request->getParameter('customer', array());

		if (!preg_match('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/',$values['email'])) {
				$this->data["error"] = I18n::get("enter_valid_email");
				return "register";
		}
		if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$/',$values['password'])) {
				$this->data["error"] = I18n::get("valid_pw");
				return "register";
		}
		//Hash password
	  $values['password'] = password_hash($values['password'], PASSWORD_DEFAULT);

		Customer::registernewUser($values);

		return "login";
	}

	public function insert_product(Request $request){
		$values = $request->getParameter('product', array());
		Product::registerNewProduct($values);
		if($this->IsAdmin())return "admin";
		return $this->page403();

	}
	public function add_param(&$url, $name, $value) {
			$sep = strpos($url, '?') !== false ? '&' : '?';
			$url .= $sep . $name . "=" . urlencode($value);
			return $url;
		}
	public function EN(Request $request){
		$_SESSION['lang'] = "en";
		$sort = $request->getParameter('sort', 'ProdNo');
		$products = Product::getProducts($sort);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_products");
			return "home";
		}
		else $this->data["products"] = $products;
		$this->title = "Home";
		$sort = $request->getParameter('sort', 'ProdNo');
		$products = Product::getProducts($sort);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_products");
			return "home";
		}
		else $this->data["products"] = $products;
		$this->title = "Home";
		return "home";
	}
	public function DE(Request $request){
		$_SESSION['lang'] = "de";
		$sort = $request->getParameter('sort', 'ProdNo');
		$products = Product::getProducts($sort);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_products");
			return "home";
		}
		else $this->data["products"] = $products;
		$this->title = "Home";
		return "home";
	}

	public function updateUser(Request $request){
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "To edit please login in first!";
			return "login";
		}
		$values = $request->getParameter('customer', array());
		$customer = Customer::getCustomerbyID($_SESSION['user']);

		if (!$customer) {
			return $this->page404();
		}
		$customer->updateCustomer($values);

		$this->data["error"] = I18n::get("data_updated");
		$this->data["login"] = "Logged in";
		return "login";
	}
	public function ct_updateUser(Request $request){
		if (!$this->isLoggedIn()) {
			$this->data["message"] = "To edit please login in first!";
			return "cart_login";
		}
		$values = $request->getParameter('customer', array());
		$customer = Customer::getCustomerbyID($_SESSION['user']);

		if (!$customer) {
			return $this->page404();
		}
		$customer->updateCustomer($values);

		$this->data["error"] = I18n::get("data_updated");
		$this->data["login"] = "Logged in";
		return "cart_login";
	}

	public function getAllUsers(Request $request){
		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
		$sort = $request->getParameter('sort', 'id');
		$this->data["allcustomers"] = Customer::getUsers($sort);
		return "ajax_allusers";
	}
	public function getAllProducts(Request $request){
			$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ProdNo';
			$sort = $request->getParameter('sort', 'ProdNo');
			$this->data["allproducts"] = Product::getProducts($sort);
			return "ajax_allproducts";
		}
	public function getAllOrders(Request $request){
				$sort = isset($_GET['sort']) ? $_GET['sort'] : 'OrderNo';
				$sort = $request->getParameter('sort', 'OrderNo');
				$this->data["allorders"] = Order::getAllOrders($sort);
				return "ajax_allorders";
	}

	// Kategorie Views
	public function show_chairs(Request $request){
		$P_CategoryNo = 1;
		$products= Product::getProductsCategory($P_CategoryNo);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_results");
			return "home";
		}
		else $this->data["products"] = $products;
		return "category";
	}
	public function show_sofa(Request $request){
		$P_CategoryNo = 3;
		$products= Product::getProductsCategory($P_CategoryNo);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_results");
			return "home";
		}
		else $this->data["products"] = $products;
		return "category";
	}
	public function show_tables(Request $request){
		$P_CategoryNo = 2;
		$products= Product::getProductsCategory($P_CategoryNo);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_results");
			return "home";
		}
		else $this->data["products"] = $products;
		return "category";
	}
	public function show_shiners(Request $request){
		$P_CategoryNo = 4;
		$products= Product::getProductsCategory($P_CategoryNo);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_results");
			return "home";
		}
		else $this->data["products"] = $products;
		return "category";
	}
	//Kategorie Views Ende
	//Warenkorb
	// --- Pendent Anel ---
	public function to_order(Request $request){
		//$this->data["ProdNo"]
	}
	//Warenkorb ENDE
	public function addItemToCart(Request $request){
		$values = $request->getParameter('row', array());
		Order::addItemToOrder($values['ProdNo']);
		$_SESSION['lang'] = "de";
		$sort = $request->getParameter('sort', 'ProdNo');
		$products = Product::getProducts($sort);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_products");
			return "home";
		}
		else $this->data["products"] = $products;
		$_SESSION['cart'] = $products;
		$this->title = "Home";
		return "home";
	}

	public function cart_login(Request $request){
			if(isset($_SESSION['user'])) {
	        $this->data["login"] = "Logged in";
	    }
		return "cart_login";
	}
	public function cart_payment(Request $request){
		if(!$this->isLoggedIn())return $this->page403();
		if(isset($_SESSION['user'])) {
	        $this->data["login"] = "Logged in";
	  }
		//getOrders
		$customer = Customer::getCustomerbyID($_SESSION['user']);
		$order = Order::getOrderByCustomerID($customer->getCustomerNo());
		//getOrderPositions
		$OrderNo = $_SESSION['orderNo'];
		$orderposition = Orderpositions::getOrderPositions($OrderNo);
		if(empty($orderposition)){
			$this->data["error"] = I18n::get("no_orders");
			return "cart_table";
		}
		else $this->data["orderposition"] = $orderposition;
		/*if(isset($order))
		$OrderNo = $order->getOrderNo();
		else {
			$this->data["error"] = I18n::get("no_orders");
			return "cart_table";
		}
		$orderposition = Orderpositions::getOrderPositions($OrderNo);
		if(empty($orderposition)){
			$this->data["error"] = I18n::get("no_orders");
			return "cart_table";
		}
		else $this->data["orderposition"] = $orderposition;
*/
		return "cart_payment";
	}
	public function send_order(Request $request){
		$creditcart = $request->getParameter('creditcart', array());
		/*Formvalidation of Customer Creditcard*/
		if(isset($creditcart['number'])){
		 if ( preg_match('/^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/',$creditcart['number'])) {
		 } else {
				$this->data["error"] = I18n::get("wrong_card");
				return "cart_payment";
		   }
	  }
		if(isset($creditcart['date'])){
		 if ( preg_match('/^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/',$creditcart['date'])) {
		 } else {
				$this->data["error"] = I18n::get("wrong_date");
				return "cart_payment";
		   }
	  }
		if(isset($creditcart['cvv'])){
		 if ( preg_match('/^[0-9]{3,4}$/',$creditcart['cvv'])) {
		 } else {
				$this->data["error"] = I18n::get("wrong_cvv");
				return "cart_payment";
		   }
	  }
		/*Form Validation of Customer Data*/
		if(Controller::getCustomer()->getName() ==null) {
			$this->data["error"] = I18n::get("save_name");
			if($this->isLoggedIn())$this->data["login"] = "Logged in";
			return "cart_login";
		}
		if(Controller::getCustomer()->getSurname() ==null) {
			$this->data["error"] = I18n::get("save_surname");
			if($this->isLoggedIn())$this->data["login"] = "Logged in";
			return "cart_login";
		}
		if(Controller::getCustomer()->getStreet() ==null) {
			$this->data["error"] =  I18n::get("save_street");
			if($this->isLoggedIn())$this->data["login"] = "Logged in";
			return "cart_login";
		}
		if(!preg_match('/^[0-9]{3,4}$/',Controller::getCustomer()->getCitycode())) {
			$this->data["error"] = I18n::get("save_citycode");
			if($this->isLoggedIn())$this->data["login"] = "Logged in";
			return "cart_login";
		}
		if(Controller::getCustomer()->getCity() ==null) {
			$this->data["error"] = I18n::get("save_city");
			if($this->isLoggedIn())$this->data["login"] = "Logged in";
			return "cart_login";
		}

		$customer = Customer::getCustomerbyID($_SESSION['user']);
		Order::setOrderFinished($customer->getCustomerNo());
		$this->data["error"] = I18n::get("order_send");
		return "home";
	}
	public function search(Request $request){
		$search = $request->getParameter('search', '');
		if(empty($search)){
			$this->data["error"] = I18n::get("insert_search");
			return "home";
		}
		$products = Product::searchForProduct($search);
		if(empty($products)){
			$this->data["error"] = I18n::get("no_results");
			return "home";
		}
		else $this->data["products"] = $products;
		return "home";
	}



	// H E L P E R S
	public function getUsername($id){
		$id = (int) $id;
		$res = DB::doQuery("SELECT 'Benutzername' FROM 'user' WHERE 'ID' = $id");
		if ($res) {
			if ($student = $res->fetch_object(get_class())) {
				return $student;
			}
		}
		return null;
	}


	public function &getData() {
		return $this->data;
	}

	public function __call($function, $args) {
		throw new Exception("Not yet implemented ('$function')");
	}

	public function isLoggedIn(){
		$this->startSession();
		return isset($_SESSION['user']);
	}
	public function isOrder(){
		$this->startSession();
		return isset($_SESSION['cart']);
	}
	public function isAdmin(){
		$this->startSession();
		return isset($_SESSION['admin']);
	}

	public function cartSetwithproducts(){
		/*$this->startSession();
		$id= $_SESSION['orderNo'];
		echo $id;
		$orders = Order::getOrderByCustomerID($id);
		if(isset($orders))return true;
		return false;*/
	}

	public function getTitle() {
		return $this->title;
	}
	public static function printCustomerEmail(){
		$customer= Controller::getCustomer();
		$email = $customer->getEmail();
		echo $email;
	}
	public static function printCustomerPW(){
		$customer= Controller::getCustomer();
		$pw = $customer->getPassword();
		echo $pw;
	}
	public static function printCustomerName(){
		$customer= Controller::getCustomer();
		$name = $customer->getName();
		echo $name;
	}
	public static function printCustomerSurname(){
		$customer= Controller::getCustomer();
		$surname = $customer->getSurname();
		echo $surname;
	}
	public static function printCustomerStreet(){
		$customer= Controller::getCustomer();
		$street = $customer->getStreet();
		echo $street;
	}
	public static function printCustomerCitycode(){
		$customer= Controller::getCustomer();
		$citycode = $customer->getCitycode();
		echo $citycode;
	}
	public static function printCustomerCity(){
		$customer= Controller::getCustomer();
		$city = $customer->getCity();
		echo $city;
	}
	public static function printOrderDate(){
		$customer= Controller::getOrder();
		$city = $customer->getOrderDate();
		echo $city;
	}
	public static function printProductName($id){
		$product= Product::getProductbyID($id);
		$productname = $product->getTitleDE();
		echo $productname;
	}
	public static function printProductPrice($id){
		$productoption= Productoption::getProductoptionbyID($id);
		$productname = $productoption->getPOPrice();
		echo $productname;
	}


	// P R I V A T E  H E L P E R S

	private function getCustomer(){
		$customer = Customer::getCustomerbyID($_SESSION['user']);
		if (!$customer) return $this->page404();
		return $customer;
	}
	private function page403() {
		header("HTTP/ 403 Not Found");
		return "page403";
	}

	private function page404() {
		header("HTTP/ 404 Not Found");
		return "page404";
	}

	private function internalRedirect($action, $request){
		$tpl = $this->$action($request);
		return $tpl ? $tpl : $action;
	}

	private function redirect($action) {
		header("Location: index.php?action=$action");
		exit();
	}

	private function startSession(){
		if (!$this->sessionState && !isset($_SESSION)){
			$this->sessionState = session_start();
		}
  }


}
