<?php 
class baseIdentity{
	private $table;
    private $db;
    private $connect;
 
    public function __construct($table,$adapter) {
        $this->table=(string) $table;
        $this->connect=null;
        $this->db=$adapter;
    }
     
    public function getConnect(){
        return $this->connect;
    }
     
    public function db(){
        return $this->db;
    }
     
    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY id DESC");
          
        //Return the array
        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
         
        return $resultSet;
    }
     
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");
 
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
         
        return $resultSet;
    }
     

    public function getBy($column,$value){
        if( $stmt=$this->db()->prepare("SELECT * from $this->table where $column=? Limit 1")){
            $stmt->bind_param('s',$value);
            $stmt->execute();
            $stmt=$stmt->get_result();
            if($stmt->num_rows==1){
                $row = $stmt->fetch_assoc();
                return $row;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
  
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        return $query;
    }
     
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        return $query;
    }
     

}

 ?>