<?php

$error_message = "";

if (!empty($_POST)) {
    $user = new User();
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $hasError = false;

    //Verify email
    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $hasError = true;
    }

    //Verify username
    $user_exist = $user->getByEmail($_POST['email']);
    if ($user_exist != null) {
        $hasError = true;
        $error_message .= "Username already exists\n";
    }

    //Verify password
    if (strlen($password) < 3 || strlen($password) > 10) {
        $hasError = true;
        $error_message .= "Invalid password\n";
    } elseif ($password != $confirm_password) {
        $hasError = true;
        $error_message .= "Invalid password\n";
    }
    //Requete
    if ($hasError == false) {
        $error_message = "";
        $user->register($username, $email, $password);
        header('Location: index.php?p=login');
        exit(); // Ajout de exit pour s'assurer que le script s'arrête après la redirection
    }
}
require('templates/header.php');
?>


<div class="login">
    <div class="error-message"><?php echo $error_message ?></div>
    <div class="login-title ">
        <h1>Sign Up</h1>
        <p>Create an account and become a member</p>
    </div>

    <div class="login-form">

        <form action="" method="post" name="form" id="form">

            <div class="form-group">
                <input type="text" name="username" id="username" class="form-sesion" placeholder="Choose a username*"
                    required>
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" class="form-sesion" placeholder="Email*" required>
            </div>

            <div class="form-group ">
                <input type="password" name="password" id="password" class="form-sesion"
                    placeholder="Create a password*" required>
            </div>
            <div class="form-group ">
                <input type="password" name="confirm_password" id="confirm_password" class="form-sesion"
                    placeholder="Confirm your password*" required>
            </div>

            <div class="form-group">
                <button type="submit" class="login-btn">Sign Up</button>
            </div>

        </form>
    </div>

    <div class="login-link">
        <a href="index.php?p=login">Back to sign in</a>
    </div>
</div>




</div>
<script type="module" src='/JS/register.js'></script>
</body>

</html>