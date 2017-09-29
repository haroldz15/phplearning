<?php 
class Connect(){
	private $driver,$host, $user, $pass, $database, $charset;

	public function __construct(){
		$db_config=required_once('config/database');
		$this->driver = $db_config['$driver'];
		$this->host = $db_config['host'];
		$this->user = $db_config['user'];  
		$this->pass = $db_config['pass']; 
		$this->database = $db_config['database'];
		$this->charset = $db_config['charset'];
	}

	public function connection(){
		if($this->driver=="mysql" || $this->driver ==null){
			$con= new mysql($this->host,$this->user, $this->pass, $this->database);
			$con->set_charset($this->charset);
		}

 		return $con;
    }
     
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        if($this->driver=="mysql" || $this->driver==null){
            $pdo = new PDO($this->driver.":dbname=".$this->database, $this->user, $this->pass);
            $fpdo = new FluentPDO($pdo);
        }
         
        return $fpdo;
    }

}

 ?>