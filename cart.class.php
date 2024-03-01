<?php

class Cart
{
    public function AddToCart($productId)
    {
        if (!isset($_SESSION['Cart']))
        {
            $_SESSION['Cart'] = array();
        }

        $cartItems = $_SESSION['Cart'];

        for ($i = 0; $i < count($cartItems); $i++)
        {
            if ($cartItems[$i]['productId'] == $productId)
            {
                $cartItems[$i]['quantity']++; // change if this is going to be an option in product page
                $_SESSION['Cart'] = $cartItems;
                return;
            }
        }

        $newCartItem = array (
            'productId' => $productId,
            'quantity' => 1 // can change when quantity option is add to product page    
        );

        array_push($cartItems, $newCartItem);

        $_SESSION['Cart'] = $cartItems;
    }

    public function PrepareCartForCheckout()
    {
        $cartItems = $_SESSION['Cart'];

        for ($i = 0; $i < count($cartItems); $i++)
        {
            $productId = $cartItems[$i]['productId'];
            
            require_once 'products.class.php';
            $products = new Product();
            $foundProduct = $products->getProduct($productId);

            $cartItems[$i]['pricePerUnit'] = $foundProduct[0]['price'];
            $cartItems[$i]['productName'] = $foundProduct[0]['product_name'];
            $cartItems[$i]['description'] = $foundProduct[0]['description'];
            $cartItems[$i]['subTotal'] = $foundProduct[0]['price'] * $cartItems[$i]['quantity'];
        }

        $_SESSION['Cart'] = $cartItems;
    }

    public function Delete($productId)
    {
        $cartItems = $_SESSION['Cart'];

        for ($i = 0; $i < count($cartItems); $i++)
        {
            echo $cartItems[$i]['productId'] == $productId;
            if ($cartItems[$i]['productId'] == $productId)
            {
                array_splice($cartItems, $i,1);
            }
        }

        
        $_SESSION['Cart'] = $cartItems;
        Header('Location: '.$_SERVER['PHP_SELF']);
    }
}

?>