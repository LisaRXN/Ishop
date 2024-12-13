<?php

require '../vendor/autoload.php';
require '../app/Autoloader.php';


use League\OAuth2\Client\Provider\Google;

session_start(); // Remove if session.auto_start=1 in php.ini

// Display URL
$provider = new Google([
    'clientId'     => getenv('GOOGLE_CLIENT_ID'),
    'clientSecret' => getenv('GOOGLE_CLIENT_SECRET'),
    'redirectUri'  => 'http://localhost:8000/auth/google_callback.php',
]);
 $token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

// Recupere les informations du user
try {
    $ownerDetails = $provider->getResourceOwner($token);

} catch (Exception $e) {
    exit('Something went wrong: ' . $e->getMessage());

}

// Force le login du user
$users_table = new User();
$username = $ownerDetails->getLastName();
session_start();
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
header( 'Location: ../index.php?p=home');

 

