<?php
class DB extends mysqli{

	static private $instance;

	static public function create($host, $user, $pw, $dbname) {
		@self::$instance = new DB($host, $user, $pw, $dbname);
		return self::$instance->connect_errno == 0;
	}

	static public function getInstance() {
		return self::$instance;
	}

	static public function doQuery($sql) {
		// May do some exception handling right here
		return self::getInstance()->query($sql);
	}

	public function __construct($host, $user, $pw, $dbname) {
		parent::__construct($host, $user, $pw, $dbname);
	}
}
