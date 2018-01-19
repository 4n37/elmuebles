<?php
class Customer implements JsonSerializable{

	private $CustomerNo;
	private $Name;
	private $Surname;
	private $Street;
	private $Citycode;
	private $City;
	private $Email;
	private $Password;
	private $IsAdmin;

	function __construct() {
	    }

	public function jsonSerialize(){
		return[
			'Name' => $this->Name,
			'email' => $this->Email,
		];
	}

	public function getCustomerNo() {
			return $this->CustomerNo;
	}
	public function getName() {
			return $this->Name;
	}
	public function getSurname() {
			return $this->Surname;
	}
	public function getStreet() {
			return $this->Street;
	}
	public function getCitycode() {
				return $this->Citycode;
	}
	public function getCity() {
				return $this->City;
	}
	public function getEmail() {
				return $this->Email;
	}
	public function getPassword() {
				return $this->Password;
	}
	public function getIsAdmin() {
				return $this->IsAdmin;
	}

	static public function getUsers($orderBy="CustomerNo") {
		$orderByStr = '';
		if (in_array($orderBy, ['CustomerNo', 'Name', 'Surname', 'Street', 'Citycode', 'City', 'Email', 'Password']) ) {
			$orderByStr = " ORDER BY $orderBy";
		}
		$allcustomers = array();
		$res = DB::doQuery("SELECT * FROM customer");
		if ($res) {
			while ($customers = $res->fetch_object(get_class())) {
				$allcustomers[] = $customers;
			}
		}
		return $allcustomers;
	}
		static public function checkAuthorization($username, $password){
		$username = DB::getInstance()->real_escape_string($username);
		$password = DB::getInstance()->real_escape_string($password);
		$res = DB::doQuery("SELECT * FROM customer WHERE email = '$username'");
		if($res){
				if($user = $res->fetch_object(get_class())){
					if(password_verify($password, $user->getPassword()))
						return $user;
				}
		}
		return null;
	}

	static public function getCustomerbyID($username) {
		$username = DB::getInstance()->real_escape_string($username);
		$res = DB::doQuery("SELECT * FROM customer WHERE email = '$username'");
		if($res){
				if($user = $res->fetch_object(get_class())){
						return $user;
				}
		}
		return null;
		}

   static public function registernewUser($values) {
		 $db = DB::getInstance();
		 $values['name'] = $db->real_escape_string($values['name']);
		 $values['surname'] = $db->real_escape_string($values['surname']);
		 $values['street'] = $db->real_escape_string($values['street']);
		 $values['citycode'] = $db->real_escape_string($values['citycode']);
		 $values['city'] = $db->real_escape_string($values['city']);
		 $values['email'] = $db->real_escape_string($values['email']);
		 $values['password'] = $db->real_escape_string($values['password']);
		 if ($stmt = $db->prepare("INSERT INTO customer (Name, Surname, Street, Citycode, City, Email, Password) VALUE (?,?,?,?,?,?,?);")) {
		  if ($stmt->bind_param('sssisss', $values['name'], $values['surname'], $values['street'], $values['citycode'], $values['city'], $values['email'],$values['password'])) {
		 		if ($stmt->execute()) {
					return $stmt->insert_id;
				}
		 	}
		 }
		 return false;
 	 }

	 public function updateCustomer($values) {
		$db = DB::getInstance();
 		$this->name = $db->real_escape_string($values['name']);
 		$this->surname = $db->real_escape_string($values['surname']);
		$this->street = $db->real_escape_string($values['street']);
		$this->citycode = $db->real_escape_string($values['citycode']);
		$this->city = $db->real_escape_string($values['city']);
		//Save Data
		$sql = sprintf("UPDATE customer SET Name='%s', Surname='%s', Street='%s', Citycode='%s', City='%s' WHERE CustomerNo = %d;",$this->name, $this->surname, $this->street,$this->citycode,$this->city, $this->CustomerNo);
		$res = DB::doQuery($sql);
		return $res != null;
  }

}
