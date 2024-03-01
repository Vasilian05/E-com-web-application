<?php
include  'dbh.class.php';

class OrderLine extends Dbh {

    public function AddOrderLines($orderId, $orderLines)
    {
        $db = $this->connect();

        foreach($orderLines as $orderLine)
        {
            $sql = "INSERT INTO orderLines (product_id, price_per_unit, quantity, sub_total, order_id) VALUES (?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);
            
            $stmt->execute([$orderLine['productId'], $orderLine['pricePerUnit'], $orderLine['quantity'], $orderLine['subTotal'], $orderId]);
        }
    }
}
?>