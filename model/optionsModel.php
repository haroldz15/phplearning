<?php
class optionsModel extends baseModel{
    private $table;
     
    public function __construct($adapter){
        $this->table="options";
        parent::__construct($this->table,$adapter);
    }
     

    public function getOptions($flags){
    $error_msg="";
    $flagsArray = explode(" ", $flags);
    $prep_stmt = "SELECT name,action,flags,icon FROM `options`";
    $stmt = $this->db()->prepare($prep_stmt);
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name,$action,$flags_id,$icon);
        $user_options = array();
                while ($stmt->fetch()) {
                        // Get all the user roles to the array user_roles
                        for ($i=0; $i < sizeof($flagsArray); $i++) { 
                            if(strpos($flags_id,$flagsArray[$i])!==false){
                                $user_options[]=array(
                                "name"=>$name,
                                "action"=>$action,
                                "icon"=>$icon
                                );
                                continue 2;
                            }
                        }
                }
                $stmt->close();
        } else {
                $error_msg .= 'Database error';
                $stmt->close();
        }
    if (empty($error_msg)) {
            return $user_options;
    }
    }
}
?>