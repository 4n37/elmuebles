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

  static public function getOrderPositions($OrderNo) {
		$orderBy="order_no";
		$orderByStr = '';
    if (in_array($orderBy, ['pos_no','order_no','product_no', 'product_opt_no','quantity']) ) {
      $orderByStr = " ORDER BY $orderBy";
    }
		$OrderNo = DB::getInstance()->real_escape_string($OrderNo);
		$allpositions = array();
		$res = DB::doQuery("SELECT * FROM orderpositions WHERE order_no = '$OrderNo'");
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
  static public function getOrderPositionByOrder($OrderNo,$ProdOptNo) {
    $OrderNo = DB::getInstance()->real_escape_string($OrderNo);
    $ProdOptNo = DB::getInstance()->real_escape_string($ProdOptNo);
		$res = DB::doQuery("SELECT * FROM orderpositions WHERE order_no = '$OrderNo' AND product_opt_no='$ProdOptNo' ");
		if($res){
				if($orderposition = $res->fetch_object(get_class())){
						return $orderposition;
				}
		}
		return null;
	}
  static public function clearOrderPositions($OrderNo) {
		$OrderNo = DB::getInstance()->real_escape_string($OrderNo);
		$allpositions = array();
		$res = DB::doQuery("DELETE FROM orderpositions WHERE order_no = '$OrderNo'");
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

  static public function addItemToOrder($ProdNo, $ProdOptNo){
    $db = DB::getInstance();
    $orderno = $_SESSION['orderNo'];
    $ProdOptNo = $db->real_escape_string($ProdOptNo);
    $ProdNo = $db->real_escape_string($ProdNo);
    $res = DB::doQuery("SELECT pos_no FROM orderpositions WHERE order_no = '$orderno' AND product_opt_no='$ProdOptNo'");
    if($res->num_rows === 0){

        $answer = DB::doQuery("INSERT INTO orderpositions (order_no, product_no,product_opt_no, quantity) VALUES ($orderno,$ProdNo,$ProdOptNo,1)");
        return true;
    }
    //Product increment
    $quantity = DB::doQuery("SELECT quantity FROM orderpositions WHERE order_no = '$orderno' AND product_no='$ProdNo' AND product_opt_no='$ProdOptNo'");
    if($quantity){
				if($position = $quantity->fetch_object(get_class())){
            $position;
		}}
    $quantity = $position->getQuantity();
    $sql = sprintf("UPDATE orderpositions SET quantity='%d' WHERE order_no = '$orderno' AND product_no='$ProdNo' AND product_opt_no='$ProdOptNo'", $quantity+1);
    $res = DB::doQuery($sql);
    return true;

  }

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
