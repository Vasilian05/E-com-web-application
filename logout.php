<?php 
    //set cookie
    setcookie('email', $email, time() - (86400 * 30), "/"); // 86400 = 1 day

    setcookie('name', $data['first_name'], time() - (86400 * 30), "/"); // 86400 = 1 day

    setcookie('userid', $data['user_id'], time() - (86400 * 30), "/"); // 86400 = 1 day

    setcookie('is_logged_in', true, time() - (86400 * 30), "/"); // 86400 = 1 day

    Header('Location: index.php');