<?php 
class connect {

	private $driver,$host, $user, $pass, $database, $charset;

	public function __construct(){
		$db_config=require_once 'config/database.php';
		$this->driver = $db_config['driver'];
		$this->host = $db_config['host'];
		$this->user = $db_config['user'];  
		$this->pass = $db_config['pass']; 
		$this->database = $db_config['database'];
		$this->charset = $db_config['charset'];
	}

	public function connection(){
		if($this->driver=="mysql" || $this->driver ==null){
			$con= new mysqli($this->host,$this->user, $this->pass, $this->database);
			$con->set_charset($this->charset);
		}

 		return $con;
    }
     
}

 ?>