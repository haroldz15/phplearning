<?php
class documentsModel extends baseModel{
    private $table;
     
    public function __construct($adapter){
        $this->table="invoice_header";
        parent::__construct($this->table,$adapter);
    }
     

    public function getInvoices(){
    $error_msg="";
    $prep_stmt = "SELECT a.id,b.name,a.client_to,a.dateInvoice,a.date_due FROM `invoice_header` as a ,`companies` as b where a.company=b.id and a.status='1'";
    $stmt = $this->db()->prepare($prep_stmt);
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id,$company,$client_to,$dateInvoice,$date_due);
        $invoices = array();
            while ($stmt->fetch()) {
                $invoices[]=array(
                "id"=>$id,
                "company"=>$company,
                "client_to"=>$client_to,
                "dateInvoice"=>$dateInvoice,
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
}
?>