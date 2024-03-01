<?php include 'include/header.php';?>
<?php include 'cart.class.php';?>

<?php
$cart = new Cart();

if (isset($_SESSION['Cart']))
{
  $cart->PrepareCartForCheckout();
  $cartItems = $_SESSION['Cart'];
}

if (isset($_POST['btnDelete']))
{
  $cart->Delete($_POST['productId']);
}

?>
<div class="container text-center">
  
  <h1>Your Order:</h1>
  <hr>
  <div class="row">
    <div class="col-8 mt-5">
      
      <?php 
        $sub_total = 0;
        if (count($cartItems) == 0)
        {
        ?>
          <div class="row align-items-start">
            <div class="col mt-5 w-50">
              <h4>No products in cart</h4>
            </div>
          </div>
        <?php 
        }
        else 
        {
        ?>
          <div class="row mb-3 text-start">
            <div class="col-1">
              <strong>Image</strong>
            </div>
            
            <div class="col-2">
              <strong>Product Name</strong>
            </div>
          
            <div class="col-3">
              <strong>Description</strong>
            </div>
            
            <div class="col-1">
              <strong>Quantity</strong>
            </div>

            <div class="col-2">
              <strong>Price Per Unit</strong>
            </div>
            
            <div class="col-2">
              <strong>Sub Total</strong>
            </div>
            
            <div class="col-1">
              
            </div>
          </div>
        <?php
        }
        foreach($cartItems as $cartItem) 
        {
          $sub_total += $cartItem['subTotal'];?>
          <div class="row text-start">
            <div class="col-1">
              <img class="rounded w-100" src="Photo21-09-2014_132933_c0e770fa-d9a9-4be4-a289-36fec3942252.jpg.webp" alt="product image">
            </div>
            
            <div class="col-2">
              <h5><?php echo $cartItem['productName']?></h5>
            </div>
          
            <div class="col-3">
              <p><?php echo substr($cartItem['description'], 0, 50) . "..."?></p>
            </div>
            
            <div class="col-1">
              <p><?php echo $cartItem['quantity']; ?></p>
            </div>

            <div class="col-2">
              <p>£<?php echo number_format((float)$cartItem['pricePerUnit'], 2, '.', '')?></p>
            </div>
            
            <div class="col-2">
              <h5>£<?php echo number_format((float)$cartItem['subTotal'], 2, '.', '')?></h5>
            </div>
            
            <div class="col-1">
              <div class="row">
                <form method="post">
                  <input type="hidden" name="productId" value="<?php echo $cartItem['productId']?>">
                  <input type="submit" class="btn btn-outline-dark" value="X" name="btnDelete">
                </form>
              </div>
            </div>
          </div>
          <hr>
          <?php }?>
    </div>
            
    <div class="col-4 mt-5">
      <?php $estimate_delivery_cost = 0; ?>
      <div class="col text-start ms-4">
        <h2>Summary</h2>
        <div class="row align-items-start">
          <div class="col">
            <p>Subtotal:</p>
          </div>
          <div class="col text-end">
            <p>£<?php echo number_format((float)$sub_total, 2, '.', ''); ?></p>
          </div>
        </div>

        <div class="row align-items-start">
          <div class="col">
            <p>Estimated delivary fees:</p>
          </div>
          <div class="col text-end">
          <p>£<?php echo number_format((float)$estimate_delivery_cost, 2, '.', ''); ?></p>
          </div>
        </div>

        <?php $vat = ($sub_total / 100) * 20?>
        <div class="row align-items-start">
          <div class="col">
            <p>VAT:</p>
          </div>
          <div class="col text-end">
          <p>£<?php echo number_format((float)$vat, 2, '.', ''); ?></p>
          </div>
        </div>

        <hr>


        <?php $order_total = $sub_total + $estimate_delivery_cost + $vat; ?>
        <div class="row align-items-start">
          <div class="col">
            <p>Order Total:</p>
          </div>
          <div class="col text-end">
          <p>£<?php echo number_format((float)$order_total, 2, '.', ''); ?></p>
          </div>
        </div>
        <button class="btn btn-outline-dark mt-2">Checkout</button>
        <button class="btn btn-outline-primary mt-2">PayPal</button>
    </div>
  </div>
      
      
      
    
  
    
</div>


<?php include 'include/footer.php';?>

