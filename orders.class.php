<?php
include 'dbh.class.php';

class Orders extends Dbh 
{
    private $orderTotal;

    public function SetOrderTotol($orderTotal)
    {
        $this->orderTotal = $orderTotal;
    }

    // Add order
    public function AddOrder()
    {
        // connect to db
        $db = $this->connect();

        $sql = 'INSERT INTO order(user_id, order_total) VALUES(?, ?)';

        $stmt = $db->prepare($sql);

        if($stmt->execute([$_COOKIE['userid'], $this->orderTotal]))
        {
            return $db->lastInsertId();
        }
    }
}
?>