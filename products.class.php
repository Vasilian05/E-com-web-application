<?php
include 'dbh.class.php';

class Product extends Dbh 
{
  public function GetAllProducts()
  {
      $sql = "SELECT * FROM products";
      $stmt = $this->connect()->query($sql);

      return $stmt->fetchAll();         
  }
  
  public function getProduct($id)
  {
    $stmt = $this->connect()->prepare('SELECT * FROM products WHERE product_id = ?');

    if($stmt->execute([$id])) 
    {
      $product = $stmt->fetchAll();
      return $product;
    }
  }
}





