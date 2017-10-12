<?php
class document_body extends baseIdentity{
    private $id;
    private $orderId;
    private $quantity;
    private $product;
    private $description;
    private $price;
    private $status;

     
    public function __construct($adapter) {
        $table="document_body";
        parent::__construct($table,$adapter);
    }
     
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }

    public function getOrderId() {
        return $this->orderId;
    }
 
    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    public function getQuantity() {
        return $this->quantity;
    }
 
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getProduct() {
        return $this->product;
    }
 
    public function setProduct($product) {
        $this->product = $product;
    }

    public function getDescription() {
        return $this->description;
    }
 
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }
 
    public function setPrice($price) {
        $this->price = $price;
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