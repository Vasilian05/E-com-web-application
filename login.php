<?php 
include 'include/header.php';
require 'users.class.php';
?>

<?php
if(isset($_POST['bntLogin']))
{
    $emailTxt = $_POST['email'];
    $pwdTxt = $_POST['pwd'];

    $user = new User($emailTxt, $firstName??"", $lastName??"", $pwdTxt);
    $data = $user->checkLogin();

    if($data == null) 
    {
        echo "Login unsuccessful, please try again";
    } 
    else 
    {
        //set cookie
        setcookie('email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day

        setcookie('name', $data['first_name'], time() + (86400 * 30), "/"); // 86400 = 1 day

        setcookie('userid', $data['user_id'], time() + (86400 * 30), "/"); // 86400 = 1 day

        setcookie('is_logged_in', true, time() + (86400 * 30), "/"); // 86400 = 1 day

        header("Location:index.php");
    }
}



?>
<h1 class="text-center mt-4">Login</h1>
<form method="POST" class="w-25 mt-5 m-auto text-center">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="email" aria-describedby="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1">
  </div>
  <div id="emailHelp" class="form-text mb-3">We'll never share your details with anyone else.</div>
  </div>
    <input type="submit" class="btn btn-primary" value="Login" name="bntLogin"/>
</form>


<?php include'include/footer.php'; ?>