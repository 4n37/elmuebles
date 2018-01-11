<?php
class Order implements JsonSerializable{

	private $OrderNo;
	private $OrderDate;
	private $CustomerNo;
	private $IsFinished;


	function __construct() {
			}
	public function jsonSerialize(){
				return[
					'OrderNo' => $this->OrderNo,
					'OrderDate' => $this->OrderDate,
				];
	}

	public function getOrderNo() {
			return $this->OrderNo;
	}
	public function getOrderDate() {
			return $this->OrderDate;
	}
	public function getCustomerNo() {
			return $this->CustomerNo;
	}
  public function getIsFinished() {
			return $this->IsFinished;
	}

	//Erstelle oder öffne Order für diese Session
	static public function init() {

		if(isset($_SESSION['orderNo'])){

			//echo "OrderNo ist bereits generiert: {$_SESSION['orderNo']} !";

		}else{

			$db = DB::getInstance();
			$temporderno = DB::doQuery("SELECT OrderNo FROM orders WHERE OrderNo = (SELECT MAX(OrderNo) FROM orders)");
			if ($temporderno) {
				while ($temp = $temporderno->fetch_object(get_class())) {
					$out[] = $temp;
				}
			}
			foreach($out as $ordernumber)
				//echo($ordernumber->getOrderNo());
			$temporderno = $ordernumber->getOrderNo() + 1;

			$answer = DB::doQuery("INSERT INTO orders (OrderNo, OrderDate, CustomerNo, IsFinished) VALUES ($temporderno,null,null,false)");

			$_SESSION['orderNo'] = $temporderno;

			//echo "Generierte OrderNo ist: {$temporderno} !";

		}
  }

	//Füge Bestellposition ein
	static public function addItemToOrder($value){

		//echo "addItem ProNo: {$value} !"; //OK hier ist die Produktnummer

		$orderno = $_SESSION['orderNo'];

		$answer = DB::doQuery("INSERT INTO orderpositions (order_no, product_no,product_opt_no, quantity) VALUES ($orderno,$value,5,1)");

		//$db = DB::getInstance();
		//$values['title_de'] = $db->real_escape_string($values['title_de']);

	}

	static public function getOrderPositionsByOrderID($orderid){
		echo "getOrderPosByOrderID orderid = {$orderid} !";
		//SELECT product.P_desc_DE, orderpositions.quantity FROM orderpositions INNER JOIN product ON orderpositions.product_no=product.ProdNo WHERE orderpositions.order_no = 1003;
		$res = DB::doQuery("SELECT product.P_desc_DE, orderpositions.quantity FROM orderpositions INNER JOIN product ON orderpositions.product_no=product.ProdNo WHERE orderpositions.order_no = {$orderid}");
		if($res){
			if($orderpos = $res->fetch_object(get_class())){
					return $orderpos;
		}else{
			echo "KEIN MATCH FUR {$orderid} !";
		}
	}
}

	static public function getOrderByCustomerID($id) {
		$username = DB::getInstance()->real_escape_string($id);
		$res = DB::doQuery("SELECT * FROM orders WHERE CustomerNo = '$id'");
		if($res){
				if($user = $res->fetch_object(get_class())){
						return $user;
				}
		}
		return null;
	}

	static public function setOrderFinished($cusomterid){
		$db = DB::getInstance();
		$IsFinished = "1";
		$CustomerNo = $db->real_escape_string($cusomterid);
		//Save Data
		$sql = sprintf("UPDATE orders SET IsFinished='%d' WHERE CustomerNo = %s;", $IsFinished, $CustomerNo);
		$res = DB::doQuery($sql);
		return $res != null;
	}

	static public function getAllOrders($orderBy="OrderNo") {
		$orderByStr = '';
		if (in_array($orderBy, ['OrderNo', 'OrderDate', 'CustomerNo', 'IsFinished']) ) {
			$orderByStr = " ORDER BY $orderBy";
		}
		$allorders = array();
		$res = DB::doQuery("SELECT * FROM orders");
		if ($res) {
			while ($order = $res->fetch_object(get_class())) {
				$allorders[] = $order;
			}
		}
		return $allorders;
	}



}
