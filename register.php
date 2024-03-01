<?php include_once 'include/header.php';?>

<?php
if(isset($_POST['btnRegister'])) 
{
  // Grabbing form data
  $email = $_POST['email'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $pass = $_POST['pass'];

  //instantiate user class
  include 'classes/users.class.php';

  $signup = new User($email, $firstName, $lastName, $pass);

  $signup->signupUser();
}

?>




    <h1 class="text-center mt-4">Register</h1>
<form method="POST" class="w-25 mt-5 m-auto text-center">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="email" aria-describedby="email">
  </div>
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">First name</label>
    <input type="text" name="firstName" class="form-control" id="firstName" aria-describedby="firstName">
  </div>
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Last name</label>
    <input type="text" name="lastName" class="form-control" id="lastName" aria-describedby="lastName">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
  </div>
  <div id="emailHelp" class="form-text mb-3">We'll never share your details with anyone else.</div>
  </div>
    <input type="submit" class="btn btn-primary" value="Register" name="btnRegister"/>
</form>


<?php include 'include/footer.php'; ?>


