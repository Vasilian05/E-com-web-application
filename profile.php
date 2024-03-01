<?php 

    include 'include/header.php';
    include 'profile.class.php';?>

<?php 

    $user = new Profile();
    $user_data = $user->getUser($_COOKIE['userid']);

    if(isset($_POST['submit'])) {
        echo 'posted';
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->updateDetails();

        Header('Location: profile.php');
    }
?>


<div class="container text-center mt-5 w-50">

    <h1>Profile</h1>        
    <form method="POST">
        <div class="info mt-5">
            

            <div class="input-group mb-5 ">
                <input type="text" name="firstName" class="form-control" disabled value="<?php echo $user_data[0]['first_name'];?>" aria-label="Recipient's username" aria-describedby="button-addon2">
            </div>
            
            <div class="input-group mb-5">
                <input type="text" name="lastName" class="form-control"  disabled value="<?php echo $user_data[0]['last_name'];?>" aria-label="Recipient's username" aria-describedby="button-addon2">
            </div>
            
            <div class="input-group mb-5">
                <input type="text" name="email" class="form-control" disabled value="<?php echo $user_data[0]['email'];?>" aria-label="Recipient's username" aria-describedby="button-addon2">
                
            </div>
        </div>
        <button class="btn btn-outline-dark w-25" type="button" onclick="functionEnable()" id="button-addon2">Edit</button>
        <button type="submit" class="btn btn-outline-dark w-25" name="submit" id="button-addon2">Save</button>
        
    </form>
</div>
<script>
function functionEnable() {
let element = document.querySelectorAll('.form-control');


for (let i = 0; i < element.length; i++) {
    element[i].toggleAttribute("disabled")

    }
}
</script>



<?php include 'include/footer.php';?>