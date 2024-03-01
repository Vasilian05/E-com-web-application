<?php include_once 'include/header.php';
require 'products.class.php';?>

<?php
  if(isset($_POST['btnAdd']))
  {
    require_once 'cart.class.php';
    $cart = new Cart();

    $cart->AddToCart($_POST['productId']);
  }
?>

<div class="container text-center mt-3">
<h1>Our Coffee</h1>
  <hr></hr>

<div class="col-12 ">

  <?php 
    $productInstance = new Product();

    $products = $productInstance->GetAllProducts();

    foreach ($products as $product) 
    {
      $id = $product['product_id']?>
    
      <div class="d-inline-block">
        <form method="POST">
          <div class="card d-inline-block mx-5 mt-5 " style="width: 18rem;">
            <img src="Photo21-09-2014_132933_c0e770fa-d9a9-4be4-a289-36fec3942252.jpg.webp" class="card-img-top" alt="...">
          
            <div class="card-body">
              <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
              <p class="card-text"><?php echo $product['description']; ?></p>
              <p class="card-text">£<?php echo $product['price']; ?></p>
              <input type="hidden" name="productId" value="<?php echo $id ?>">
              <button name='btnAdd' type='submit' class='btn btn-outline-dark'>Add</button>
            </div>
          </div>
        </form>
      </div>
    <?php } ?>
  
  <div class="row align-items-start">
    <div class="col">
      <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDark" aria-labelledby="offcanvasDarkLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasDarkLabel">Opening times:</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvasDark" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Day</th>
      <th scope="col">Open</th>
      <th scope="col">Close</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Monday</th>
      <td>9:00</td>
      <td>19:00</td>
    </tr>
    <tr>
      <th scope="row">Tuesday</th>
      <td>9:00</td>
      <td>19:00</td>
    </tr>
    <tr>
      <th scope="row">Wednesday</th>
      <td>9:00</td>
      <td>19:00</td>
    </tr>
    <tr>
      <th scope="row">Thursday</th>
      <td>9:00</td>
      <td>19:00</td>
    </tr>
    <tr>
      <th scope="row">Friday</th>
      <td>9:00</td>
      <td>19:00</td>
    </tr>
    <tr>
      <th scope="row">Sat-Sun</th>
      <td>11:00</td>
      <td>15:00</td>
    </tr>
  </tbody>

</table>
    </div>
</div>
    </div>
</div>









<?php include 'include/footer.php'?>