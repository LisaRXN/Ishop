<?php
require '../app/Autoloader.php';

// verification du token et expiration
$token = $_GET['token'];
$user_table = new User();
$user = $user_table->getByToken($_GET['token']);
$token_expire = $user->token_expire;
$error_message = "";

// Si le lien a expiré
if (time() > $token_expire) {
    $error_message = "Oups, le lien a expiré...";
    $expire=true;
}

// Sinon, formulaire de reset
else {
    $error_message = "";

    if (!empty($_POST)) {
        $user_table = new User();
        $user = $user_table->getByToken($_GET['token']);
        $id = $user->id;
        $admin = $user->admin;
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $hasError = false;

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
            $user->updatePassword($id, $password);
            header('Location: ../index.php?p=login');
            exit();
        }
    }
}
?>



<html>

<header>
    <link rel="stylesheet" href="/public/reset.css" />
    <link rel="stylesheet" href="/public/style.css" />
</header>

<body>


    <div class="login reset" style=<?= $expire ? "" : "display:none"; ?> >
        <div class="login-title reset-title ">
            <h1> <?= $error_message ?> </h1>
            <a href="/index.php?p=reset_form">Envoyer un nouveau lien</a>
        </div>
    </div>


    <div class="login" style=<?= $expire ? "display:none": ""; ?>>
        <div class="error-message"><?php echo $error_message ?></div>
        <div class="login-title ">
            <h1>Reset Password</h1>
            <p>Enter your new password below.</p>
        </div>

        <div class="login-form">

            <form action="" method="post" name="form" id="form">

                <div class="form-group ">
                    <input type="password" name="password" id="password" class="form-sesion"
                        placeholder="Create a password*" required>
                </div>
                <div class="form-group ">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-sesion"
                        placeholder="Confirm your password*" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="login-btn">Reset Password</button>
                </div>

            </form>
        </div>

        <div class="login-link">
            <a href="../index.php?p=login">Back to sign in</a>
        </div>
    </div>


    </div>
    <!-- <script type="module" src='/JS/register.js'></script> -->
</body>

</html>