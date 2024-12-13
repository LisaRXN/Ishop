<?php
require './vendor/autoload.php'; 

\Stripe\Stripe::setApiKey(getenv('APIKEY'));

if (isset($_POST["total"])) {
    $total = $_POST["total"];
}


try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'My Shop',
                ],
                'unit_amount' =>$total*100
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost:8000/index.php?p=home', // Remplace par l'URL de succès
        'cancel_url' => 'http://localhost:8000/index.php?p=cart',   // Remplace par l'URL d'annulation
    ]);

    // Redirige vers l'URL de la session Stripe
    header('Location: ' . $session->url);
    exit();
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
