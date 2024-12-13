<?php
$users_table = new User();
$error_message = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $admin = trim($_POST['admin']);
    $hasError = false;

    if ($admin != 0 && $admin != 1) {
        $hasError = true;
        $error_message .= "Invalid admin.\n";
    }

    if ($hasError == false) {
        $error_message = "";
        $users_table->add($username, $email, $admin );
        header( 'Location: index.php?p=users');
        exit();
    }
}

require 'header.admin.php';


?>

<div class="edit">

    <h1>Add User</h1>

    <div class="error-message"><?php echo $error_message ?></div>

<div class="edit-form">

    <form action="" method="post">

        <label for ="username" >Username</label>
        <input class="edit-input" type="text" name="username" required>
        
            <label for ="email" >Email</label>
            <input class="edit-input" type="email" name="email"required>
            
            <label for ="admin" >Role</label>
            <input class="edit-input" type="number" name="admin" required>

        <button type="submit" name="submit" class="product-btn edit-btn">Confirm add</button>

    </form>
    </div>


</div>


<script type="module" src='/JS/add_category.js'></script>
