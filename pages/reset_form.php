<?php

require('templates/header.php');

?>



<div class="login">
    <div class="error-message"><?php echo $error_message ?></div>
    <div class="login-title ">
        <h1>Reset Password</h1>
        <br>
        <p>Enter your login email and we will send you a link to reset your password.</p>

    </div>

    <div class="login-form">
        <form action="/index.php?p=reset_confirm" method="post" name="form" id="form">
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-sesion" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <button type="submit" class="login-btn">Reset Password</button>
            </div>


        </form>


    </div>

    <div class="login-link">
        <a href="/index.php?p=login">Back to login</a>
    </div>

</div>