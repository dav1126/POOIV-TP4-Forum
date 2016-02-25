<?php
class PDO2 extends PDO {
	
	private static $_instance;
	/* Constructeur : héritage public obligatoire par héritage de PDO */
	
	public function __construct( ) {
	}
	
	/* Singleton */
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			try {
				self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
			} catch (PDOException $e) {
				echo $e;
			}
		}// if isset
			return self::$_instance;
	} //function getinstance
}//class pdo2

?>