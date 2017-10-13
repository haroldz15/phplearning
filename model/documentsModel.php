<?php
class documentsModel extends baseModel{
    private $table;
     
    public function __construct($adapter){
        $this->table="invoice_header";
        parent::__construct($this->table,$adapter);
    }
     

    public function getInvoices(){
        $error_msg="";
        $prep_stmt = "SELECT a.id,b.name,a.client_to,a.dateDocument,a.date_due FROM `invoice_header` as a ,`companies` as b where a.company=b.id and a.status='1'";
        $stmt = $this->db()->prepare($prep_stmt);
        if ($stmt) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$company,$client_to,$dateDocument,$date_due);
            $invoices = array();
                while ($stmt->fetch()) {
                    $invoices[]=array(
                    "id"=>$id,
                    "company"=>$company,
                    "client_to"=>$client_to,
                    "dateDocument"=>$dateDocument,
                    "date_due"=>$date_due
                    );            
                }
                $stmt->close();

            if (empty($invoices)) {
                return false;
            }else{
                return $invoices;   
            }           
        } else {
            $error_msg .= 'Database error';
            $stmt->close();
        }
    }

    public function getEstimates(){
        $error_msg="";
        $prep_stmt = "SELECT a.id,b.name,a.client_to,a.dateDocument,a.date_due FROM `estimate_header` as a ,`companies` as b where a.company=b.id and a.status='1'";
        $stmt = $this->db()->prepare($prep_stmt);
        if ($stmt) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$company,$client_to,$dateDocument,$date_due);
            $invoices = array();
                while ($stmt->fetch()) {
                    $invoices[]=array(
                    "id"=>$id,
                    "company"=>$company,
                    "client_to"=>$client_to,
                    "dateDocument"=>$dateDocument,
                    "date_due"=>$date_due
                    );            
                }
                $stmt->close();

            if (empty($invoices)) {
                return false;
            }else{
                return $invoices;   
            }           
        } else {
            $error_msg .= 'Database error';
            $stmt->close();
        }
    }

    function saveDocumentBody($arrayBody){
    $error_msg="";
        if ($insert_stmt =$this->db()->prepare("
            INSERT into `document_body` (id, orderId, quantity,description) values (?,?, ?, ?) 
            ON DUPLICATE KEY UPDATE
            quantity = VALUES(quantity),
            description = VALUES(description)"))
        {
            foreach ($arrayBody as $key => $item) {
                $item=(array)$item;
                $insert_stmt->bind_param('iiis',$item["id"],$item["orderId"],$item["quantity"],$item["description"]);    
                if (! $insert_stmt->execute()) {
                    $error_msg .= 'Database error';
                }else{
                    //return true;
                }            

            }
        }else{
           $error_msg .= 'Database error';
        }
        if (empty($error_msg)) {    
            return true;
         } else {
            return false;
         }
    }

    public function getDocumentBody($id,$table){
    $error_msg="";
    echo $table;
    $prep_stmt = "SELECT id,orderId,quantity,description FROM `$table` where id=?";
    $stmt = $this->db()->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id,$orderId,$quantity,$description);
        $document_body = array();
            while ($stmt->fetch()) {
                $document_body[]=array(
                "id"=>$id,
                "orderId"=>$orderId,
                "quantity"=>$quantity,
                "description"=>$description
                );            
            }
            $stmt->close();

        if (empty($document_body)) {
            return false;
        }else{
            return $document_body;   
        }           
    } else {
        $error_msg .= 'Database error';
        $stmt->close();
    }

    }



    function deleteItem($id,$orderId){
        if( $stmt=$this->db()->prepare("DELETE  from `document_body` where id=? and orderId=?")){
            $stmt->bind_param('ii',$id,$orderId);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->affected_rows==1){
               return $_GET['callback']."(".json_encode(array("result" => true)).")";
            }else{
              return $_GET['callback']."(".json_encode(array("result" => false)).")";
            }
        }else{
            return $_GET['callback']."(".json_encode(array("result" => false)).")";
        }
    }
}
?>