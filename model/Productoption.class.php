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
  static public function getProductoptionbyProdID($ProdNo) {
		$ProdNo = DB::getInstance()->real_escape_string($ProdNo);
		$res = DB::doQuery("SELECT * FROM productopt WHERE ProdNo = '$ProdNo'");
		if($res){
				if($productopt = $res->fetch_object(get_class())){
						return $productopt;
				}
		}
		return null;
	}
  static public function getProductoptionsbyProdID($ProdNo) {
    $ProdNo = DB::getInstance()->real_escape_string($ProdNo);
    $allproductoptions = array();
    $res = DB::doQuery("SELECT * FROM productopt WHERE ProdNo = '$ProdNo'");
    if ($res) {
      while ($productopt = $res->fetch_object(get_class())) {
        $allproductoptions[] = $productopt;
      }
    }
    return $allproductoptions;
	}
  static public function getProductNobyID($ProdOptNo) {
    $ProdOptNo = DB::getInstance()->real_escape_string($ProdOptNo);
    $res = DB::doQuery("SELECT ProdNo FROM productopt WHERE ProdOptNo = '$ProdOptNo'");
    if($res){
        if($productopt = $res->fetch_object(get_class())){
            return $productopt->getProdNo();
        }
    }
    return null;
  }
  static public function getProductoptionbyID($ProdOptNo) {
		$ProdOptNo = DB::getInstance()->real_escape_string($ProdOptNo);
		$res = DB::doQuery("SELECT * FROM productopt WHERE ProdOptNo = '$ProdOptNo'");
		if($res){
				if($productopt = $res->fetch_object(get_class())){
						return $productopt;
				}
		}
		return null;
	}
}
