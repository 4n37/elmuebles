<?php
class Product implements JsonSerializable {

  private $ProdNo;
  private $P_CategoryNo;
  private $P_desc_DE;
  private $P_desc_EN;
  private $P_Title_DE;
  private $P_Title_EN;
  private $P_Pictures_Big;
  private $P_Pictures_Small;

  function __construct() {
	    }

	public function jsonSerialize(){
		return[
			'P_Title_DE' => $this->P_Title_DE,
		];
	}

  public function getProdNo() {
    return $this->ProdNo;
  }
  public function getCategoryNo() {
    return $this->P_CategoryNo;
  }
  public function getProductDescDE() {
			return $this->P_desc_DE;
	}
  public function getProductDescEN() {
			return $this->P_desc_EN;
	}
  public function getTitleDE() {
			return $this->P_Title_DE;
	}
	public function getTitleEN() {
			return $this->P_Title_EN;
	}
  public function getPicturesBig() {
			return $this->P_Pictures_Big;
	}
	public function getPicturesSmall() {
			return $this->P_Pictures_Small;
	}

  static public function getProducts($orderBy="ProdNo") {
    $orderByStr = '';
    if (in_array($orderBy, ['ProdNo','P_CategoryNo','P_desc_DE', 'P_desc_EN','P_Title_DE','P_Title_EN','P_Pictures_Big','P_Pictures_Small']) ) {
      $orderByStr = " ORDER BY $orderBy";
    }
    $allproducts = array();
    $res = DB::doQuery("SELECT * FROM product");
    if ($res) {
      while ($product = $res->fetch_object(get_class())) {
        $allproducts[] = $product;
      }
    }
    return $allproducts;
  }

  static public function registerNewProduct($values) {
    $db = DB::getInstance();
    $values['desc_de'] = $db->real_escape_string($values['desc_de']);
		$values['desc_en'] = $db->real_escape_string($values['desc_en']);
    $values['title_de'] = $db->real_escape_string($values['title_de']);
    $values['title_en'] = $db->real_escape_string($values['title_en']);
    $values['pic_big'] = $db->real_escape_string($values['pic_big']);
    $values['pic_small'] = $db->real_escape_string($values['pic_small']);
    if ($stmt = $db->prepare("INSERT INTO product (P_CategoryNo, P_desc_DE,P_desc_EN,P_Title_DE,P_Title_EN, P_Pictures_Big,P_Pictures_Small) VALUE (?,?,?,?,?,?,?);")) {
     if ($stmt->bind_param('issssss', $values['category'], $values['desc_de'], $values['desc_en'], $values['title_de'], $values['title_en'], $values['pic_big'],$values['pic_small'])) {
       if ($stmt->execute()) {
         $id_ref = $stmt->insert_id;
         echo $id_ref;
       }
     }
    }
    $db = DB::getInstance();
    if ($stmt = $db->prepare("INSERT INTO productopt (ProdNo,Color,PO_Price,PO_Stock) VALUE (?,?,?,?);")) {
     if ($stmt->bind_param('isdi', $id_ref, $values['color'], $values['price'], $values['price'])) {
       if ($stmt->execute()) {
         return $stmt->insert_id;
       }
     }
   }
    return false;
  }
  static public function searchForProduct($search) {
    $orderBy="ProdNo";
    $orderByStr = '';
    if (in_array($orderBy, ['ProdNo','P_CategoryNo','P_desc_DE', 'P_desc_EN','P_Title_DE','P_Title_EN','P_Pictures_Big','P_Pictures_Small']) ) {
      $orderByStr = " ORDER BY $orderBy";
    }
    $allproducts = array();
    $search = DB::getInstance()->real_escape_string($search);
    if(isset($_SESSION['lang']) && ($_SESSION['lang'] =="en")) $res = DB::doQuery("SELECT ProdNo, P_desc_DE,P_desc_EN, P_Title_DE, P_Title_EN, P_Pictures_Big, P_Pictures_Small FROM product where P_Title_EN LIKE '%" . $search ."%'");
    else $res = DB::doQuery("SELECT ProdNo, P_desc_DE, P_desc_EN, P_Title_DE, P_Title_EN, P_Pictures_Big, P_Pictures_Small FROM product where P_Title_EN LIKE '%" . $search ."%'");
    if ($res) {
      while ($product = $res->fetch_object(get_class())) {
        $allproducts[] = $product;
      }
    }
    return $allproducts;
  }
  static public function getProductsCategory($P_CategoryNo) {
    $orderBy="ProdNo";
    $orderByStr = '';
    if (in_array($orderBy, ['ProdNo','P_CategoryNo','P_desc_DE', 'P_desc_EN','P_Title_DE','P_Title_EN','P_Pictures_Big','P_Pictures_Small']) ) {
      $orderByStr = " ORDER BY $orderBy";
    }
    $allproducts = array();
    $P_CategoryNo = DB::getInstance()->real_escape_string($P_CategoryNo);
    if(isset($_SESSION['lang']) && ($_SESSION['lang'] =="en")) $res = DB::doQuery("SELECT ProdNo, P_desc_DE,P_desc_EN, P_Title_DE, P_Title_EN, P_Pictures_Big, P_Pictures_Small FROM product WHERE `P_CategoryNo` = $P_CategoryNo");
    else $res = DB::doQuery("SELECT ProdNo, P_desc_DE, P_desc_EN, P_Title_DE, P_Title_EN, P_Pictures_Big, P_Pictures_Small FROM product WHERE `P_CategoryNo` = $P_CategoryNo");
    if ($res) {
      while ($product = $res->fetch_object(get_class())) {
        $allproducts[] = $product;
      }
    }
    return $allproducts;
  }
  static public function getProductbyID($ProdNo) {
		$ProdNo = DB::getInstance()->real_escape_string($ProdNo);
		$res = DB::doQuery("SELECT * FROM product WHERE ProdNo = '$ProdNo'");
		if($res){
				if($product = $res->fetch_object(get_class())){
						return $product;
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
