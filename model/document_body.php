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
          
    }
}
?>