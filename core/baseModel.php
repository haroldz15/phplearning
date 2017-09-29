<?php
class baseModel extends baseIdentity{
    private $table;
    private $fluent;
     
    public function __construct($table,$adapter) {
        $this->table=(string) $table;
        //Call the construct method of parent baseIdentity wich is being recalled in this contruction but by saying parent you call it anyway in order to use the getConnect
        parent::__construct($table,$adapter);
    }
     
    public function executeSql($query){
        //call the db function from the parent 
        $query=$this->db()->query($query);
        if($query==true){
            if($query->num_rows>1){
                while($row = $query->fetch_object()) {
                   $resultSet[]=$row;
                }
            }elseif($query->num_rows==1){
                if($row = $query->fetch_object()) {
                    $resultSet=$row;
                }
            }else{
                $resultSet="not found";
            }
        }else{
            $resultSet=false;
        }       
        return $resultSet;
    } 
}
?>