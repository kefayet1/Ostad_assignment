<?php
class Product{
    public $id,$name,$price;
    public function __construct($id,$name,$price){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
    public function getFormattedPrice(){
        $formatPrice = number_format($this->price, 2);
        $converToString = "$formatPrice";
        return $converToString."\n";
    }
    public function showDetails(){
        print("Product ID: {$this->id} \n product name: {$this->name} \n price: {$this->getFormattedPrice()} \n");
    }
}

$product = new Product(1,"T-shirt",19.9679);
// $product->price  = 23.23023823;
$product->showDetails();
// $product->getFormattedPrice();