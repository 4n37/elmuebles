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

}
