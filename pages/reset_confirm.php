<?php
require './vendor/autoload.php';
require './app/Autoloader.php';
require('templates/header.php');


use \Mailjet\Resources;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $users_table = new User();
    $user = $users_table->getByEmail($email);

    if ($user) {
        // Générer un token de réinitialisation
        $token = bin2hex(random_bytes(16)); // Génère un token sécurisé
        $token_expire = time() + 3600; // 3600 secondes = 1 heure


        // Sauvegarder ce token avec une expiration dans la base de données
        $user->addToken($user->id, $token, $token_expire);


        // Créer un lien de réinitialisation
        $resetLink = "http://localhost:8000/pages/reset_password.php?token=" . $token;

        $MJ_APIKEY_PUBLIC = getenv('MJ_APIKEY_PUBLIC');
        $MJ_APIKEY_PRIVATE = getenv('MJ_APIKEY_PRIVATE');


        // getenv will allow us to get the MJ_APIKEY_PUBLIC/PRIVATE variables we created before:

        $apikey = $MJ_APIKEY_PUBLIC;
        $apisecret = $MJ_APIKEY_PRIVATE;

        // Use your saved credentials, specify that you are using Send API v3.1

        $mj = new \Mailjet\Client($MJ_APIKEY_PUBLIC, $MJ_APIKEY_PRIVATE, true, ['version' => 'v3.1']);

        // Define your request body

        $SENDER_EMAIL = "lisa.eriksen@epitech.eu";
        $RECIPIENT_EMAIL = $email;

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "$SENDER_EMAIL",
                        'Name' => "My IShop"
                    ],
                    'To' => [
                        [
                            'Email' => "$RECIPIENT_EMAIL",
                            'Name' => "$user->username"
                        ]
                    ],
                    'Subject' => "Reset password!",
                    'TextPart' => "Greetings from My IShop!",
                    'HTMLPart' => "
                    <h3>Password Reset</h3>
                    <p> Seems like you forgot you password for My IShop. If this is true, click below to reset your password </p>
                    <br/>
                    <a href=\"$resetLink\">Reset Password </a>
                    <br/>
                    <p>If you did not forgot you password you can safely ignore this email.
                    "
                ]
            ]
        ];

        // All resources are located in the Resources class

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        // Read the response

        // $response->success() && var_dump($response->getData());

        $mj = new \Mailjet\Client(getenv($MJ_APIKEY_PUBLIC), getenv($MJ_APIKEY_PRIVATE), true, ['version' => 'v3.1']);

        $mj = new \Mailjet\Client(
            getenv($MJ_APIKEY_PUBLIC),
            getenv($MJ_APIKEY_PRIVATE),
            true,
            ['url' => "api.us.mailjet.com"]
        );

        $mj = new \Mailjet\Client(getenv($MJ_APIKEY_PUBLIC), getenv($MJ_APIKEY_PRIVATE), false);
    }
}


?>




<div class="login">
    <div class="error-message"><?php echo $error_message ?></div>
    <div class="login-title ">
        <h1>Check your email</h1>
        <br>
        <p>We will send you a link to set your new password by email.</p>

    </div>

    <div class="login-form">
        <div class="form-group">
            <button class="login-btn"><a href="index.php">Back to My IShop</a></button>
        </div>
    </div>

    <div class="login-link">
        <a href="/index.php?p=login">Back to login</a>
    </div>

</div>