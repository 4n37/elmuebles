<?php
class Productoption{

  private $ProdOptNo;
  private $ProdNo;
  private $Color;
  private $PO_Price;
  private $PO_Stock;

  function __construct() {
	    }


  public function getProdOptNo() {
    return $this->ProdOptNo;
  }
  public function getProdNo() {
    return $this->ProdNo;
  }
  public function getColor() {
			return $this->Color;
	}
  public function getPOPrice() {
			return $this->PO_Price;
	}
  public function getPOStock() {
			return $this->PO_Stock;
	}

  static public function getProductoptionbyID($ProdNo) {
		$id = DB::getInstance()->real_escape_string($ProdNo);
		$res = DB::doQuery("SELECT * FROM productopt WHERE ProdOptNo = '$id'");
		if($res){
				if($productopt = $res->fetch_object(get_class())){
						return $productopt;
				}
		}
		return null;
	}
}
