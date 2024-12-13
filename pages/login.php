<?php
$error_message = "";

if (!empty($_POST)) {
    $user = new User();
    $error_message = "";

    // Verification user 
    if ($user->login($_POST['email'], $_POST['password'])) {
        $error_message = "";
        session_start();
        $_SESSION['email'] = $_POST['email'];
        $user_logged = $user->getByEmail($_POST['email']);

        if ($_POST['google']) {
            header('Location: index.php?p=google');
        }

        // Redirection user 
        if ($user_logged->admin == 0) {
            header('Location: index.php?p=home');

            // Redirection admin
        } elseif ($user_logged->admin == 1) {
            $_SESSION['admin'] = 1;
            header('Location: index.php?p=admin');
        }
    } else {
        $error_message = "identifiants incorrects";
    }
}

require('templates/header.php');

?>


<div class="login">
    <div class="error-message"><?php echo $error_message ?></div>
    <div class="login-title ">
        <h1>Sign In</h1>
    </div>

    <div class="login-form">
        <form action="" method="post" name="form" id="form">
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-sesion" placeholder="Email*" required>
            </div>
            <div class="form-group ">
                <input type="password" name="password" id="password" class="form-sesion" placeholder="Password"
                    required>
                    <div class="login-link login-reset">
                    <a href="index.php?p=reset_form">Forgot your password?</a>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="login-btn">Log In</button>
            </div>

            <div class="login-or">
                <hr>
                <p> O </p>
                <hr>
            </div>


        </form>
        <div class="form-group">
            <a href="index.php/?p=google" class="login-btn login-google-btn"><img class="login-google-img"
                    src="/img/icon-google.png">Log In with Google</a>
        </div>

    </div>

    <div class="login-link">
        <a href="index.php?p=register">Create an account</a>
    </div>

</div>
</div>
</body>


<script type="module" src="./JS/login.js"></script>

</html>