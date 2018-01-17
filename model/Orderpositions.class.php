<?php
class Orderpositions
{
  private $pos_no;
  private $order_no;
  private $product_no;
  private $product_opt_no;
  private $quantity;

  public function getPosNo() {
      return $this->pos_no;
  }
  public function getOrderNo() {
      return $this->order_no;
  }
  public function getProductNo() {
      return $this->product_no;
  }
  public function getProductOptNo() {
      return $this->product_opt_no;
  }
  public function getQuantity() {
    return $this->quantity;
  }
  public function setQuantityPlus($quantity){
        $this->quantity = $quantity+1;
    }

  static public function getOrderPositions($id) {
		$orderBy="order_no";
		$orderByStr = '';
    if (in_array($orderBy, ['pos_no','order_no','product_no', 'product_opt_no','quantity']) ) {
      $orderByStr = " ORDER BY $orderBy";
    }
		$id = DB::getInstance()->real_escape_string($id);
		$allpositions = array();
		$res = DB::doQuery("SELECT * FROM orderpositions WHERE order_no = '$id'");
		if($res){
				while ($position = $res->fetch_object(get_class())) {
						$allpositions[] = $position;
				}
		}
		return $allpositions;
	}
  static public function getOrderPositionByID($OrderNo) {
    $OrderNo = DB::getInstance()->real_escape_string($OrderNo);
		$res = DB::doQuery("SELECT * FROM orderpositions WHERE order_no = '$OrderNo'");
		if($res){
				if($orderposition = $res->fetch_object(get_class())){
						return $orderposition;
				}
		}
		return null;
	}
  static public function clearOrderPositions($id) {
		/*$orderBy="order_no";
		$orderByStr = '';
    if (in_array($orderBy, ['pos_no','order_no','product_no', 'product_opt_no','quantity']) ) {
      $orderByStr = " ORDER BY $orderBy";
    }*/

		$id = DB::getInstance()->real_escape_string($id);
		$allpositions = array();
		$res = DB::doQuery("DELETE FROM orderpositions WHERE order_no = '$id'");
		if($res){
				return true;
		}
		return false;
	}

  static public function incQuantity($posno){
    $posno = DB::getInstance()->real_escape_string($posno);
    $quantity = DB::doQuery("SELECT quantity FROM orderpositions WHERE pos_no='$posno'");
    if($quantity){
				if($position = $quantity->fetch_object(get_class())){
            $position;
		}}
    $quantity = $position->getQuantity();
    $sql = sprintf("UPDATE orderpositions SET quantity='%d' WHERE pos_no='$posno'", $quantity+1);
    $res = DB::doQuery($sql);
    return true;
  }
  static public function decQuantity($posno){
    $posno = DB::getInstance()->real_escape_string($posno);
    $quantity = DB::doQuery("SELECT quantity FROM orderpositions WHERE pos_no='$posno'");
    if($quantity){
				if($position = $quantity->fetch_object(get_class())){
            $position;
		}}

    $quantity = $position->getQuantity();
    if($quantity==1) return false;
    $sql = sprintf("UPDATE orderpositions SET quantity='%d' WHERE pos_no='$posno'", $quantity-1);
    $res = DB::doQuery($sql);
    return true;
  }
  //@Todo Produktoptionen anpassen!!!!!
  static public function addItemToOrder($ProdNo){
    $db = DB::getInstance();
    $ProdNo = $db->real_escape_string($ProdNo);

    $orderno = $_SESSION['orderNo'];

    //@Todo when product option

    $res = DB::doQuery("SELECT pos_no FROM orderpositions WHERE order_no = '$orderno' AND product_no='$ProdNo'");
    if($res->num_rows === 0){
        //Product not in orderposition
        $answer = DB::doQuery("INSERT INTO orderpositions (order_no, product_no,product_opt_no, quantity) VALUES ($orderno,$ProdNo,5,1)");
        return true;
    }
    //Product increment
    $quantity = DB::doQuery("SELECT quantity FROM orderpositions WHERE order_no = '$orderno' AND product_no='$ProdNo'");
    if($quantity){
				if($position = $quantity->fetch_object(get_class())){
            $position;
		}}
    $quantity = $position->getQuantity();
    $sql = sprintf("UPDATE orderpositions SET quantity='%d' WHERE order_no = '$orderno' AND product_no='$ProdNo'", $quantity+1);
    $res = DB::doQuery($sql);
    return true;

  }
  //Füge Bestellposition ein
  static public function removeItemFromOrderposition($posno){
    //Product in orderposition
    $orderno = $_SESSION['orderNo'];
    $posno = DB::getInstance()->real_escape_string($posno);
		$res = DB::doQuery("SELECT * FROM orderpositions WHERE order_no = '$orderno' AND pos_no='$posno'");
		if($res->num_rows === 0){
				//Product not in orderposition
        return false;
		}
    $res = DB::doQuery("DELETE FROM orderpositions WHERE pos_no = '$posno'");
    return true;
  }

}
