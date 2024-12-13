<?php
$users_table = new User();
$user = $users_table->getById($_GET['id']);
$error_message = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $id = trim($_POST['id']);
    $email = trim($_POST['email']);
    $admin = trim($_POST['admin']);
    $hasError = false;

    if ($admin != 0 && $admin != 1) {
        $hasError = true;
        $error_message .= "Invalid admin.\n";
    }

    if ($hasError == false) {
        $error_message = "";
        $user->update($username, $id, $email, $admin  );
        header( 'Location: index.php?p=users');
        exit();
    }
}

require 'header.admin.php';


?>

<div class="edit">

    <h1>Edit User</h1>

    <div class="error-message"><?php echo $error_message ?></div>

<div class="edit-form">

    <form action="" method="post">
        
        <label for ="id" >Id</label>
        <input class="edit-input" type="text" name="id" value="<?= $user->id ?> " readOnly="readOnly">
        
        <label for ="username" >Username</label>
        <input class="edit-input" type="text" name="username"
            value="<?=str_replace("-", " ", $user->username); ?>" required>
        
            <label for ="email" >Email</label>
            <input class="edit-input" type="email" name="email" value="<?= $user->email ?>" required>
            
            <label for ="admin" >Role</label>
            <input class="edit-input" type="number" name="admin" value="<?= $user->admin ?>" required>

        <button type="submit" name="submit" class="product-btn edit-btn">Confirm edit</button>

    </form>
    </div>


</div>



<script type="module" src='/JS/edit_user.js'></script>