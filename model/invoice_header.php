<?php
class invoice_header extends baseIdentity{
    private $id;
    private $company;
    private $client_to;
    private $client_address;
    private $date_due;
    private $observations;
    private $subtotal;
    private $tax;
    private $taxAmount;
    private $total;
    private $dateInvoice;
    private $user;
    private $status;


     
    public function __construct($adapter) {
        $table="invoice_header";
        parent::__construct($table,$adapter);
    }
     
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }

    public function getCompany() {
        return $this->company;
    }
 
    public function setCompany($company) {
        $this->company = $company;
    }

    public function getClient_to() {
        return $this->client_to;
    }
 
    public function setClient_to($client_to) {
        $this->client_to = $client_to;
    }

    public function getClient_address() {
        return $this->client_address;
    }
 
    public function setClient_address($client_address) {
        $this->client_address = $client_address;
    }

    public function getDate_due() {
        return $this->date_due;
    }
 
    public function setDate_due($date_due) {
        $this->date_due = $date_due;
    }

    public function getObservations() {
        return $this->observations;
    }
 
    public function setObservations($observations) {
        $this->observations = $observations;
    }   

    public function getSubtotal() {
        return $this->subtotal;
    }
 
    public function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    public function getTax() {
        return $this->tax;
    }
 
    public function setTax($tax) {
        $this->tax = $tax;
    }

    public function getTaxAmount() {
        return $this->taxAmount;
    }
 
    public function setTaxAmount($taxAmount) {
        $this->taxAmount = $taxAmount;
    }

    public function getTotal() {
        return $this->total;
    }
 
    public function setTotal($total) {
        $this->total = $total;
    }   

    public function getDateInvoice() {
        return $this->dateInvoice;
    }
 
    public function setDateInvoice($dateInvoice) {
        $this->dateInvoice = $dateInvoice;
    }

    public function getUser() {
        return $this->user;
    }
 
    public function setUser($user) {
        $this->user = $user;
    }  

    public function getStatus() {
        return $this->status;
    }
 
    public function setStatus($status) {
        $this->status = $status;
    }

    public function save(){
        if ($insert_stmt =$this->db()->prepare("
            INSERT INTO `invoice_header` (id,company,client_to,client_address,date_due,observations,subtotal,tax,taxAmount,total,dateInvoice,user,status) 
            VALUES (?,?, ?, ?, ?,?, ?, ?, ?,?, ?, ?, '1') 
            ON DUPLICATE KEY UPDATE
            company = VALUES(company),
            client_to = VALUES(client_to),
            client_address = VALUES(client_address),
            date_due = VALUES(date_due),
            observations = VALUES(observations),
            subtotal = VALUES(subtotal),
            tax = VALUES(tax),
            taxAmount = VALUES(taxAmount),
            total = VALUES(total),
            user=VALUES(user),
            status=VALUES(status)")) {

            $insert_stmt->bind_param('iissssddddsi',$this->id,$this->company,$this->client_to,$this->client_address,$this->date_due,$this->observations,$this->subtotal,$this->tax,$this->taxAmount,$this->total,$this->dateInvoice,$this->user);    
            if (! $insert_stmt->execute()) {
                return false;
            }else{
                $this->id =$this->db()->insert_id;
                return true;
            }
        }else{
            return false;
        }              
    }
}
?>