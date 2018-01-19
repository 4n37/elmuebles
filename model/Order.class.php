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
					'CustomerNo' => $this->CustomerNo,
					'IsFinished' => $this->IsFinished,
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

	// Create Order Number for every customer
	static public function init() {

		if(isset($_SESSION['orderNo'])){
			$OrderNo = $_SESSION['orderNo'];
			$db = DB::getInstance();
			$OrderNo = DB::getInstance()->real_escape_string($OrderNo);
			$orderfinish = DB::doQuery("SELECT * FROM orders WHERE IsFinished = '0' AND OrderNo = $OrderNo");
			if($orderfinish->num_rows !== 0){
				return true;
			}
		}
		$timezone = date_default_timezone_get();
		$year = date('Y', time());
		$month = date('m', time());
		$day = date('d', time());
		$date = $year."-".$month."-".$day;
		$db = DB::getInstance();
		$temporderno = DB::doQuery("SELECT OrderNo FROM orders WHERE OrderNo = (SELECT MAX(OrderNo) FROM orders)");
		if($temporderno->num_rows === 0)
		 {
			 $answer = DB::doQuery("INSERT INTO orders (OrderNo, OrderDate, CustomerNo, IsFinished) VALUES ('1000','$date',null,false)");
			 $_SESSION['orderNo'] = 1;
			 return true;
	 		}
		if ($temporderno) {
			while ($temp = $temporderno->fetch_object(get_class())) {
				$out[] = $temp;
			}
		}

		foreach($out as $ordernumber)
			$temporderno = $ordernumber->getOrderNo() + 1;
		$answer = DB::doQuery("INSERT INTO orders (OrderNo, OrderDate, CustomerNo, IsFinished) VALUES ($temporderno,'$date',null,false)");

		$_SESSION['orderNo'] = $temporderno;

  }
	static public function updateOrder($OrderNo, $CustomerNo){
		$db = DB::getInstance();
		$CustomerNo = $db->real_escape_string($CustomerNo);
		$OrderNo = $db->real_escape_string($OrderNo);
		$sql = sprintf("UPDATE orders SET CustomerNo='%d' WHERE OrderNo = '%d' AND IsFinished=0;", $CustomerNo, $OrderNo);
		$res = DB::doQuery($sql);
		//Insert new order when order not exists
		if($res == null){
			$timezone = date_default_timezone_get();
			$year = date('Y', time());
			$month = date('m', time());
			$day = date('d', time());
			$date = $year."-".$month."-".$day;
			$answer = DB::doQuery("INSERT INTO orders (OrderNo, OrderDate, CustomerNo, IsFinished) VALUES ($OrderNo,'$date',$CustomerNo,false)");
		}
	}

	static public function setOrderFinished($CustomerNo){
		$db = DB::getInstance();
		$IsFinished = "1";
		$CustomerNo = $db->real_escape_string($CustomerNo);
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
